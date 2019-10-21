<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

# Classe específica               - vendor/bin/phpunit tests/Unit/Models/CategoryTest.php
# Método específico em um arquivo - vendor/bin/phpunit --filter testIfUseTraits tests/Unit/Models/CategoryTest.php
# Método específico em uma classe - vendor/bin/phpunit --filter CategoryTest::testIfUseTraits

class CategoryTest extends TestCase
{
    private $category;

    /* Executa logo que começa o teste apenas uma vez */
    //public static function setUpBeforeClass()
    //{
        //parent::setUpBeforeClass();
    //}

    /* Executa antes do teste */
    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    /* Executa depois do teste */
    //protected function tearDown(): void
    //{
    //    parent::TearDown();
    //}

    //public static function tearDownAfterClass()
    //{
        //parent::tearDownAfterClass();
    //}

    public function testIfUseTraits()
    {
        $traits = [
            SoftDeletes::class,
            Uuid::class
        ];
        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testFillableAttribute()
    {
        $fillable = ['name','description','is_active'];
        $this->assertEquals($fillable, $this->category->getFillable());
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at','created_at','updated_at'];
        foreach($dates as $date){
            $this->assertContains($date, $this->category->getDates());
        }
        $this->assertCount(count($dates), $this->category->getDates());
    }

    public function testCastsAttibute()
    {
        $casts = ['id' => 'string', 'is_active' => 'boolean'];
        $this->assertEquals($casts, $this->category->getCasts());
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->category->incrementing);
    }

}
