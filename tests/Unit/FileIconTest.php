<?php

namespace Tests\Unit;

use Tests\TestCase;

class FileIconTest extends TestCase
{
    protected $fileIcon;

    public function setUp()
    {
        parent::setUp();
        $this->fileIcon = $this->app->make("App\Models\Helpers\FileMediaInfo\FileIcon");
    }

    /** @test */
    public function can_determine_that_file_extension_has_related_icon()
    {
        $this->assertTrue($this->fileIcon->hasRelatedIcon("png"));
    }

    /** @test */
    public function can_determine_that_file_extension_does_not_have_related_icon()
    {
        $this->assertFalse($this->fileIcon->hasRelatedIcon("cap"));
    }
}
