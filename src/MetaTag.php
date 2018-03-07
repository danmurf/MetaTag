<?php 

namespace danmurf;

/**
 * Meta tag library for accumulating and rendering HTML head meta tags.
 * 
 * @author Dan Murfitt <dan@murfitt.net>
 */
class MetaTag
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var boolean
     */
    protected $noindex;

    /**
     * @var array
     */
    protected $keywords;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $canonical_url;

    /**
     * Output the meta tags.
     * 
     * @return string All the completed meta tags for the head section.
     */
    public function render($indent_spaces = 0)
    {
        $this->prefix = str_repeat(" ", $indent_spaces);

        $output = "";
        $output .=  $this->render_noindex();
        $output .=  $this->render_keywords();
        $output .=  $this->render_description();
        $output .=  $this->render_author();
        $output .=  $this->render_canonical();

        return $output;
    }

    /**
     * Render a head tag.
     * 
     * @param string $type The type of tag, e.g. meta, or link.
     * @param array $attributes A key value array of attributes
     * 
     * @return string The head tag string.
     */
    private function render_tag($type, $attributes = array())
    {
        $tag = $this->prefix . '<' . $type;

        foreach ($attributes as $attribute => $value)
        {
            $tag .= ' ' . $attribute . '="' . $value . '"';
        }

        $tag .= ">\n";

        return $tag;
    }

    /**
     * Clean the content so it is suitable for a meta tag content field.
     * 
     * @param string $content Dirty string, with tags, quotes and what not.
     * 
     * @return string Clean string, which won't break tags and will look nice.
     */
    private function sanitise_content($content)
    {
        //Remove any tags
        $content = strip_tags($content);

        //Remove newlines from content
        $content = trim(preg_replace('/\s+/', ' ', $content));

        //Remove any double quotes
        $content = str_replace('"', '', $content);

        return $content;
    }

    /**
     * Whether to add a noindex tag to the page.
     * 
     * @param boolean $value True if you would like the page not to be indexed.
     */
    public function noindex($value)
    {
        $this->noindex = $value;
    }

    /**
     * Render the noindex tag.
     * 
     * @return string The final noindex tag string.
     */
    public function render_noindex()
    {
        return $this->noindex == true ? $this->render_tag('meta', ['name' => 'robots', 'content' => 'noindex, noarchive, nofollow']) : null;
    }

    /**
     * Set the page meta keywords.
     * 
     * @param array $keywords An array of keywords to include.
     */
    public function keywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * Render the keywords tag.
     * 
     * @return string The final keywords meta tag.
     */
    public function render_keywords()
    {
        return sizeof($this->keywords) > 0 ? $this->render_tag('meta', ['name' => 'keywords', 'content' => $this->sanitise_content(implode(", ", $this->keywords))]) : null;
    }

    /**
     * Set the page meta description.
     * 
     * @param string $description A description of the page.
     */
    public function description($description)
    {
        $this->description = $description;
    }

    /**
     * Render the description meta tag.
     * 
     * @return string The final description meta tag string.
     */
    public function render_description()
    {
        return strlen($this->description) > 0 ? $this->render_tag('meta', ['name' => 'description', 'content' => $this->sanitise_content($this->description)]) : null;
    }

    /**
     * Set the page's author meta tag.
     * 
     * @param string $author The name of the author.
     */
    public function author($author)
    {
        $this->author = $author;
    }

    /**
     * Render the author meta tag.
     * 
     * @return string The final author meta tag.
     */
    public function render_author()
    {
        return strlen($this->author) > 0 ? $this->render_tag('meta', ['name' => 'author', 'content' => $this->sanitise_content($this->author)]) : null;
    }

    /**
     * Set the page's canonical URL.
     * 
     * @param string $url The page's canonical URL.
     * 
     * @return null
     */
    public function canonical($url)
    {
        $this->canonical_url = $url;
    }

    /**
     * Render the canonical URL link tag.
     * 
     * @return string The page's canonical URL tag.
     */
    public function render_canonical()
    {
        return strlen($this->canonical_url) > 0 ? $this->render_tag('link', ['rel' => 'canonical', 'href' => $this->canonical_url]) : null;
    }
}
