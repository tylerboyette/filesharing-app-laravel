<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Testing\FileFactory;
use Illuminate\Support\Facades\Storage;

class AvatarServiceTest extends TestCase
{
    protected $avatarService;
    protected $pathToSavedAvatar;

    public function setUp()
    {
        parent::setUp();
        $this->avatarService = $this->app->make("App\Models\Services\AvatarService");
    }

    public function tearDown()
    {
        if (Storage::disk("local")->exists($this->pathToSavedAvatar)) {
            Storage::disk("local")->delete($this->pathToSavedAvatar);
        }

        parent::tearDown();
    }

    /** @test */
    public function saves_resized_avatar()
    {
        $avatar = (new FileFactory())->image("test.jpg",1200, 800);
        $this->pathToSavedAvatar = $this->avatarService->handleUploadedFile($avatar);
        $avatarSize = getimagesize(storage_path("app/{$this->pathToSavedAvatar}"));
        $avatarWidth = $avatarSize[0];
        $avatarHeight = $avatarSize[1];

        Storage::disk("local")->assertExists($this->pathToSavedAvatar);
        $this->assertTrue($avatarWidth === 300 && $avatarHeight === 300);
    }

    /** @test */
    public function removes_existing_avatar()
    {
        $avatar = (new FileFactory())->image("test.jpg",1200, 800);
        $avatar->storeAs("public/avatars/", "test.jpg");
        $this->avatarService->deleteAvatarFromStorage("test.jpg");

        Storage::disk("local")->assertMissing("public/avatars/test.jpg");
    }
}
