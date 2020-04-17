<?php
global $CFG;

class block_cocoon_featured_image extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_featured_image', 'block_cocoon_featured_image');

        $this->heading = 'Heading';
        $this->subheading = 'Heading';
        $this->btntext = 'Heading';
        $this->btnurl = 'Heading';
        $this->image = 'Heading';
    }

    // Declare second
    public function specialization()
    {
        $this->heading = isset($this->config->heading) ? format_string($this->config->heading) : 'Heading';
        $this->subheading = isset($this->config->subheading) ? format_string($this->config->subheading) : 'Heading';
        $this->btntext = isset($this->config->btntext) ? format_string($this->config->btntext) : 'Heading';
        $this->btnurl = isset($this->config->btnurl) ? format_string($this->config->btnurl) : 'Heading';
        $this->image = isset($this->config->image) ? format_string($this->config->image) : 'Heading';
    }

    function applicable_formats() {
        return array(
          'all' => true,
          'my' => false,
        );
    }


    public function get_content()
    {
        global $CFG, $DB;

        if ($this->content !== null) {
            return $this->content;
        }

        // Declare third
        $this->content         =  new stdClass;
        $this->content->text   = 'The content of our Parallax block!';
        $this->content->footer = 'Footer here...';



        if (! empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }

        if (! empty($this->config->heading)) {
            $this->content->heading = $this->config->heading;
        }
        if (! empty($this->config->subheading)) {
            $this->content->subheading = $this->config->subheading;
        }
        if (! empty($this->config->btntext)) {
            $this->content->btntext = $this->config->btntext;
        }

        if (! empty($this->config->btnurl)) {
            $this->content->btnurl = $this->config->btnurl;
        }
        if (! empty($this->config->image)) {
            $this->content->image = $this->config->image;
        }


        $this->content->text = '

        <section class="divider_home1 bg-img2 parallax" data-stellar-background-ratio="0.3">
      		<div class="container">
      			<div class="row">
      				<div class="col-lg-8 offset-lg-2 text-center">
      					<div class="divider-one">
      						<p class="color-white">'. format_text($this->content->heading, FORMAT_HTML, array('filter' => true)) .'</p>
      						<h1 class="color-white text-uppercase">'. format_text($this->content->subheading, FORMAT_HTML, array('filter' => true)) .'</h1>
      						<a class="btn btn-transparent divider-btn" href="'. format_text($this->content->btnurl, FORMAT_HTML, array('filter' => true)) .'">'. format_text($this->content->btntext, FORMAT_HTML, array('filter' => true)) .'</a>
      					</div>
      				</div>
      			</div>
      		</div>
      	</section>



        ';


        return $this->content;
    }
}
