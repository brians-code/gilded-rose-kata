<?php

namespace GildedRoseTests;

use PHPUnit\Framework\TestCase;
use GildedRose\Program;
use GildedRose\Item;

class Test extends TestCase
{
  
  protected $items, $app;
  
  protected function setUp()
  {
    $this->item = new Item(
      array (
        'name' => 'Item',
        'sellIn' => '10',
        'quality' => '10'
      )
    );
    $this->app = new Program( array( $this->item ) );
  }
  
  public function testItemCanBeCreated()
  {
    $this->assertInstanceOf(Item::class, $this->item);
  }

  public function testProgramCanBeCreated()
  {
    $this->assertInstanceOf(Program::class, $this->app);
  }

  public function testUpdateOrdinaryItemSellIn()
  {
    $this->item->name = 'Ordinary Item';
    $this->app->UpdateOrdinaryItem($this->item);
    $this->assertEquals($this->item->sellIn, 9);
  }

  public function testUpdateOrdinaryItemQuality()
  {
    $this->item->name = 'Ordinary Item';
    $this->app->UpdateOrdinaryItem($this->item);
    $this->assertEquals($this->item->quality, 9);
  }
  
  public function testUpdateAgedBrieSellIn()
  {
    $this->item->name = 'Aged Brie';
    $this->app->UpdateAgedBrie($this->item);
    $this->assertEquals($this->item->sellIn, 9);
  }

  public function testUpdateAgedBrieQualitySellIn10()
  {
    $this->item->name = 'Aged Brie';
    $this->app->UpdateAgedBrie($this->item);
    $this->assertEquals($this->item->quality, 11);
  }

  public function testUpdateAgedBrieQualitySellIn0()
  {
    $this->item->name = 'Aged Brie';
    $this->item->sellIn = 0;
    $this->app->UpdateAgedBrie($this->item);
    $this->assertEquals($this->item->quality, 12);
  }
  
  public function testUpdateAgedBrieQualityDoesNotExceed50()
  {
    $this->item->name = 'Aged Brie';
    $this->item->quality = 50;
    $this->app->UpdateAgedBrie($this->item);
    $this->assertEquals($this->item->quality, 50);
  }
  
  public function testUpdateSulfurasSellIn()
  {
    $this->item->name = 'Sulfuras, Hand of Ragnaros';
    $this->app->UpdateSulfuras($this->item);
    $this->assertEquals($this->item->sellIn, 10);
  }
  
  public function testUpdateSulfurasQuality()
  {
    $this->item->name = 'Sulfuras, Hand of Ragnaros';
    $this->app->UpdateSulfuras($this->item);
    $this->assertEquals($this->item->quality, 10);
  }
  
  public function testUpdateBackstagePassesSellIn()
  {
    $this->item->name = 'Backstage passes to a TAFKAL80ETC concert';
    $this->app->UpdateBackstagePasses($this->item);
    $this->assertEquals($this->item->sellIn, 9);
  }
  
  public function testUpdateBackstagePassesQualitySellIn11()
  {
    $this->item->name = 'Backstage passes to a TAFKAL80ETC concert';
    $this->item->sellIn = 11;
    $this->app->UpdateBackstagePasses($this->item);
    $this->assertEquals($this->item->quality, 11);
  }
  
  public function testUpdateBackstagePassesQualitySellIn10()
  {
    $this->item->name = 'Backstage passes to a TAFKAL80ETC concert';
    $this->app->UpdateBackstagePasses($this->item);
    $this->assertEquals($this->item->quality, 12);
  }
  
  public function testUpdateBackstagePassesQualitySellIn5()
  {
    $this->item->name = 'Backstage passes to a TAFKAL80ETC concert';
    $this->item->sellIn = 5;
    $this->app->UpdateBackstagePasses($this->item);
    $this->assertEquals($this->item->quality, 13);
  }
  
  public function testUpdateBackstagePassesQualityDoesNotExceed50()
  {
    $this->item->name = 'Backstage passes to a TAFKAL80ETC concert';
    $this->item->quality = 50;
    $this->app->UpdateBackstagePasses($this->item);
    $this->assertEquals($this->item->quality, 50);
  }
  
  public function testItemTypeOrdinary()
  {
    $this->item->name = 'Test Item';
    $this->assertEquals( $this->app->getItemType($this->item), 'ORDINARY');
  }
  
  public function testItemTypeAgedBrie()
  {
    $this->item->name = 'Aged Brie';
    $this->assertEquals( $this->app->getItemType($this->item), 'AGED BRIE');
  }
  
  public function testItemTypeSulfuras()
  {
    $this->item->name = 'Sulfuras';
    $this->assertEquals( $this->app->getItemType($this->item), 'SULFURAS');
  }
  
  public function testItemTypeBackstagePasses()
  {
    $this->item->name = 'Backstage passes';
    $this->assertEquals( $this->app->getItemType($this->item), 'BACKSTAGE PASSES');
  }

}
