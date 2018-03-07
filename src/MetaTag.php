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
    protected $noIndex;

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
    protected $canonicalUrl;

    /**
     * Output the meta tags.
     * 
     * @param int $indentSpaces The number of spaces to indent the tags, for tidyness.
     * 
     * @return string All the completed meta tags for the head section.
     */
    public function render($indentSpaces = 0): string
    {
        $this->prefix = str_repeat(" ", $indentSpaces);

        $output = "";
        $output .=  $this->renderNoindex();
        $output .=  $this->renderKeywords();
        $output .=  $this->renderDescription();
        $output .=  $this->renderAuthor();
        $output .=  $this->renderCanonical();

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
    private function renderTag(string $type, array $attributes = []): string
    {
        $tag = $this->prefix . '<' . $type;

        foreach ($attributes as $attribute => $value) {
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
    private function sanitiseContent($content): string
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
     * 
     * @return MetaTag
     */
    public function setNoIndex(bool $value): MetaTag
    {
        $this->noindex = $value;

        return $this;
    }

    /**
     * Render the noindex tag.
     * 
     * @return string The final noindex tag string.
     */
    public function renderNoindex(): string
    {
        return $this->noIndex == true ? $this->renderTag('meta', ['name' => 'robots', 'content' => 'noindex, noarchive, nofollow']) : null;
    }

    /**
     * Set the page meta keywords.
     * 
     * @param array $keywords An array of keywords to include.
     * 
     * @return MetaTag
     */
    public function setKeywords(array $keywords): MetaTag
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Render the keywords tag.
     * 
     * @return string The final keywords meta tag.
     */
    public function renderKeywords(): string
    {
        return sizeof($this->keywords) > 0 ? $this->renderTag('meta', ['name' => 'keywords', 'content' => $this->sanitiseContent(implode(", ", $this->keywords))]) : null;
    }

    /**
     * Set the page meta description.
     * 
     * @param string $description A description of the page.
     * 
     * @return MetaTag
     */
    public function setDescription($description): MetaTag
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Render the description meta tag.
     * 
     * @return string The final description meta tag string.
     */
    public function renderDescription(): string
    {
        return strlen($this->description) > 0 ? $this->renderTag('meta', ['name' => 'description', 'content' => $this->sanitiseContent($this->description)]) : null;
    }

    /**
     * Set the page's author meta tag.
     * 
     * @param string $author The name of the author.
     * 
     * @return MetaTag
     */
    public function setAuthor($author): MetaTag
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Render the author meta tag.
     * 
     * @return string The final author meta tag.
     */
    public function renderAuthor(): string
    {
        return strlen($this->author) > 0 ? $this->renderTag('meta', ['name' => 'author', 'content' => $this->sanitiseContent($this->author)]) : null;
    }

    /**
     * Set the page's canonical URL.
     * 
     * @param string $url The page's canonical URL.
     * 
     * @return MetaTag
     */
    public function setCanonicalUrl(string $url): MetaTag
    {
        $this->canonicalUrl = $url;

        return $this;
    }

    /**
     * Render the canonical URL link tag.
     * 
     * @return string The page's canonical URL tag.
     */
    public function renderCanonical(): string
    {
        return strlen($this->canonicalUrl) > 0 ? $this->renderTag('link', ['rel' => 'canonical', 'href' => $this->canonicalUrl]) : null;
    }
}
