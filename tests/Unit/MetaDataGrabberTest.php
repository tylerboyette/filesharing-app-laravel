<?php

namespace Tests\Unit;

use App\Models\Helpers\FileMediaInfo\MetaDataGrabber;
use Tests\TestCase;


class MetaDataGrabberTest extends TestCase
{
    /** @test */
    public function grabs_relevant_meta_data_for_audio_file_type()
    {
        $metaDataGrabber = new MetaDataGrabber();
        $fileType = "audio";
        $fileInfo = [
            "filename" => "test.mp3",
            "filesize" => 9358362,
            "fileformat" => "mp3",
            "playtime_string" => "3:14",
            "audio" => [
                "bitrate" => 320000,
                "sample_rate" => 44100,
                "channels" => 2,
                "codec" => "LAME"
            ]
        ];
        $expectedOutput = [
            "audio" => [
                "bitrate" => 320000,
                "sample_rate" => 44100,
                "channels_count" => 2,
                "codec" => "LAME"
            ],
            "playtime_string" => "3:14"
        ];

        $this->assertEquals(
            $expectedOutput,
            $metaDataGrabber->grabMetaDataByFileType($fileType, $fileInfo)
        );
    }

    /** @test */
    public function grabs_relevant_meta_data_for_video_file_type()
    {
        $metaDataGrabber = new MetaDataGrabber();
        $fileType = "video";
        $fileInfo = [
            "filename" => "test.mp4",
            "filesize" => 9358362,
            "fileformat" => "mp4",
            "playtime_string" => "2:15",
            "audio" => [
                "sample_rate" => 48000,
                "channels" => 2,
                "codec" => "ISO/IEC 14496-3 AAC",
                "lossless" => false
            ],
            "video" => [
                "resolution_x" => 1920,
                "resolution_y" => 1080,
                "dataformat" => "quicktime"
            ]
        ];
        $expectedOutput = [
            "audio" => [
                "sample_rate" => 48000,
                "channels_count" => 2,
                "codec" => "ISO/IEC 14496-3 AAC"
            ],
            "video" => [
                "resolution_x" => 1920,
                "resolution_y" => 1080
            ],
            "playtime_string" => "2:15"
        ];

        $this->assertEquals(
            $expectedOutput,
            $metaDataGrabber->grabMetaDataByFileType($fileType, $fileInfo)
        );
    }

    /** @test */
    public function grabs_relevant_meta_data_for_image_file_type()
    {
        $metaDataGrabber = new MetaDataGrabber();

        $fileType = "image";
        $fileInfo = [
            "filename" => "test.jpg",
            "filesize" => 185674,
            "fileformat" => "jpg",
            "video" => [
                "resolution_x" => 1366,
                "resolution_y" => 768,
                "pixel_aspect_ratio" => 1,
                "lossless" => false
            ]
        ];
        $expectedOutput = [
            "fileformat" => "jpg",
            "video" => [
                "resolution_x" => 1366,
                "resolution_y" => 768
            ]
        ];

        $this->assertEquals(
            $expectedOutput,
            $metaDataGrabber->grabMetaDataByFileType($fileType, $fileInfo)
        );
    }

    /** @test */
    public function grabs_bits_per_sample_for_image_if_present()
    {
        $metaDataGrabber = new MetaDataGrabber();

        $fileType = "image";
        $fileInfo = [
            "filename" => "test.jpg",
            "filesize" => 185674,
            "fileformat" => "jpg",
            "video" => [
                "resolution_x" => 1366,
                "resolution_y" => 768,
                "pixel_aspect_ratio" => 1,
                "lossless" => false,
                "bits_per_sample" => 24
            ]
        ];
        $expectedOutput = [
            "fileformat" => "jpg",
            "video" => [
                "resolution_x" => 1366,
                "resolution_y" => 768,
                "bits_per_sample" => 24
            ]
        ];

        $this->assertEquals(
            $expectedOutput,
            $metaDataGrabber->grabMetaDataByFileType($fileType, $fileInfo)
        );
    }
}
