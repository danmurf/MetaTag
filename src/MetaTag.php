<?php

namespace danmurf;

/**
 * Meta tag library for accumulating and rendering HTML head meta tags.
 *
 * @author Dan Murfitt <dan@murfitt.net>
 */
class MetaTag
{
    /** @var string */
    protected $prefix;

    /** @var bool */
    protected $noIndex;

    /** @var array */
    protected $keywords;

    /** @var string */
    protected $description;

    /** @var string */
    protected $author;

    /** @var string */
    protected $canonicalUrl;

    /**
     * @param int $indentSpaces the number of spaces to indent the tags, for tidyness
     *
     * @return string all the completed meta tags for the head section
     */
    public function render(int $indentSpaces = 0): string
    {
        $this->prefix = str_repeat(' ', $indentSpaces);

        $output = '';
        $output .= $this->renderNoindex();
        $output .= $this->renderKeywords();
        $output .= $this->renderDescription();
        $output .= $this->renderAuthor();
        $output .= $this->renderCanonicalUrl();

        return $output;
    }

    /**
     * @param bool $value true if you would like the page not to be indexed
     *
     * @return MetaTag
     */
    public function setNoIndex(bool $value): MetaTag
    {
        $this->noIndex = $value;

        return $this;
    }

    /**
     * @return string the final noindex tag string
     */
    public function renderNoindex(): ?string
    {
        return true == $this->noIndex ? $this->renderTag('meta', ['name' => 'robots', 'content' => 'noindex, noarchive, nofollow']) : null;
    }

    /**
     * @param array $keywords an array of keywords to include
     *
     * @return MetaTag
     */
    public function setKeywords(array $keywords): MetaTag
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return string the final keywords meta tag
     */
    public function renderKeywords(): ?string
    {
        return null !== $this->keywords && sizeof($this->keywords) > 0 ? $this->renderTag('meta', ['name' => 'keywords', 'content' => $this->sanitiseContent(implode(', ', $this->keywords))]) : null;
    }

    /**
     * @param string $description a description of the page
     *
     * @return MetaTag
     */
    public function setDescription($description): MetaTag
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string the final description meta tag string
     */
    public function renderDescription(): ?string
    {
        return strlen($this->description) > 0 ? $this->renderTag('meta', ['name' => 'description', 'content' => $this->sanitiseContent($this->description)]) : null;
    }

    /**
     * @param string $author the name of the author
     *
     * @return MetaTag
     */
    public function setAuthor($author): MetaTag
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string the final author meta tag
     */
    public function renderAuthor(): ?string
    {
        return strlen($this->author) > 0 ? $this->renderTag('meta', ['name' => 'author', 'content' => $this->sanitiseContent($this->author)]) : null;
    }

    /**
     * @param string $url the page's canonical URL
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
     * @return string the page's canonical URL tag
     */
    public function renderCanonicalUrl(): ?string
    {
        return strlen($this->canonicalUrl) > 0 ? $this->renderTag('link', ['rel' => 'canonical', 'href' => $this->canonicalUrl]) : null;
    }

    /**
     * Render a head tag.
     *
     * @param string $type       The type of tag, e.g. meta, or link.
     * @param array  $attributes A key value array of attributes
     *
     * @return string the head tag string
     */
    private function renderTag(string $type, array $attributes = []): string
    {
        $tag = $this->prefix.'<'.$type;

        foreach ($attributes as $attribute => $value) {
            $tag .= ' '.$attribute.'="'.$value.'"';
        }

        $tag .= ">\n";

        return $tag;
    }

    /**
     * Clean the content so it is suitable for a meta tag content field.
     *
     * @param string $content dirty string, with tags, quotes and what not
     *
     * @return string clean string, which won't break tags and will look nice
     */
    private function sanitiseContent(string $content): string
    {
        //Remove any tags
        $content = strip_tags($content);

        //Remove newlines from content
        $content = trim(preg_replace('/\s+/', ' ', $content));

        //Remove any double quotes
        $content = str_replace('"', '', $content);

        return $content;
    }
}
