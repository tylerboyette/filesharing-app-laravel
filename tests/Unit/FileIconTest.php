<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Helpers\FileIcon;

class FileIconTest extends TestCase
{
    /** @test */
    public function can_determine_that_file_extension_has_related_icon()
    {
        $fileIcon = new FileIcon();

        $this->assertTrue($fileIcon->hasRelatedIcon("png"));
    }

    /** @test */
    public function can_determine_that_file_extension_does_not_have_related_icon()
    {
        $fileIcon = new FileIcon();

        $this->assertFalse($fileIcon->hasRelatedIcon("cap"));
    }
}
