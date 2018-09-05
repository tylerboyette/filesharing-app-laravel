<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Helpers\FileMediaInfo;


class FileMediaInfoTest extends TestCase
{
    /** @test */
    public function grabs_relevant_meta_data_for_audio_file_type()
    {
        $fileMediaInfo = new FileMediaInfo();
        $fileType = "audio";
        $fileInfo = [
            "filename" => "test.mp3",
            "filesize" => 9358362,
            "fileformat" => "mp3",
            "playtime_string" => "3:14",
            "audio" => [
                "bitrate" => 320000,
                "sample_rate" => 44100,
                "channels_count" => 2,
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

        $this->assertEquals($expectedOutput, $fileMediaInfo->grabMetaData);
    }
}
