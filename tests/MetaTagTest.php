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
         //Set the keywords
         $metatag = new MetaTag();
         $this->assertNull($metatag->keywords(['first', 'second', 'third']));

         //Check they render correctly
         $expected_result = '<meta name="keywords" content="first, second, third">'."\n";
         $this->assertEquals($expected_result, $metatag->render_keywords());
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
