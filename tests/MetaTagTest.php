<?php

use danmurf\MetaTag;

class MetaTagTest extends TestCase
{
    /**
     * @test
     * @covers \danmurf\MetaTag::keywords
     */
     public function can_set_keywords()
     {
         $metatag = new MetaTag();
         $this->assertNull($metatag->keywords(['first', 'second', 'third']));
     }

     /**
      * @test
      */
     public function can_render_keywords()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_set_no_index()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_render_no_index()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_set_description()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_render_description()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_set_author()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_render_author()
     {
         //@ToDo
     }
}
