<?php
global $CFG;

class block_cocoon_contact_form extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_contact_form', 'block_cocoon_contact_form');
    }

    // Declare second
    public function specialization()
    {
        $this->title = isset($this->config->title) ? format_string($this->config->title) : '';
    }
    public function get_content(){
        global $CFG, $DB;
        require_once($CFG->libdir . '/filelib.php');
        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;
        if(!empty($this->config->feature_1_title)){$this->content->feature_1_title = $this->config->feature_1_title;}
        if(!empty($this->config->feature_1_subtitle)){$this->content->feature_1_subtitle = $this->config->feature_1_subtitle;}
        if(!empty($this->config->feature_1_icon)){$this->content->feature_1_icon = $this->config->feature_1_icon;}
        if(!empty($this->config->feature_2_title)){$this->content->feature_2_title = $this->config->feature_2_title;}
        if(!empty($this->config->feature_2_subtitle)){$this->content->feature_2_subtitle = $this->config->feature_2_subtitle;}
        if(!empty($this->config->feature_2_icon)){$this->content->feature_2_icon = $this->config->feature_2_icon;}
        if(!empty($this->config->feature_3_title)){$this->content->feature_3_title = $this->config->feature_3_title;}
        if(!empty($this->config->feature_3_subtitle)){$this->content->feature_3_subtitle = $this->config->feature_3_subtitle;}
        if(!empty($this->config->feature_3_icon)){$this->content->feature_3_icon = $this->config->feature_3_icon;}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;}
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;}
        if(!empty($this->config->map_lat)){$this->content->map_lat = $this->config->map_lat;}
        if(!empty($this->config->map_lng)){$this->content->map_lng = $this->config->map_lng;}


        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_contact_form', 'content');
        $this->content->image = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image .=  $url;
            }
        }

        if(!empty($this->content->image)){
          $map_marker_img = $this->content->image;
        } else {
          $map_marker_img = $CFG->wwwroot.'/theme/edumy/images/resource/mapmarker.png';
        }

        $this->content->text = '
        <section class="our-contact">
      		<div class="container">
      			<div class="row">
      				<div class="col-sm-6 col-lg-4">
      					<div class="contact_localtion text-center">
      						<div class="icon"><span class="'.format_text($this->content->feature_1_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
      						<h4>'.format_text($this->content->feature_1_title, FORMAT_HTML, array('filter' => true)).'</h4>
      						<p>'.format_text($this->content->feature_1_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      					</div>
      				</div>
      				<div class="col-sm-6 col-lg-4">
      					<div class="contact_localtion text-center">
                  <div class="icon"><span class="'.format_text($this->content->feature_2_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
                  <h4>'.format_text($this->content->feature_2_title, FORMAT_HTML, array('filter' => true)).'</h4>
                  <p>'.format_text($this->content->feature_2_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      					</div>
      				</div>
      				<div class="col-sm-6 col-lg-4">
      					<div class="contact_localtion text-center">
                  <div class="icon"><span class="'.format_text($this->content->feature_3_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
                  <h4>'.format_text($this->content->feature_3_title, FORMAT_HTML, array('filter' => true)).'</h4>
                  <p>'.format_text($this->content->feature_3_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      					</div>
      				</div>
      			</div>
      			<div class="row">
      				<div class="col-lg-6">
      					<div class="h600" id="map-canvas"></div>
      				</div>
      				<div class="col-lg-6 form_grid">
      					<h4 class="mb5">'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h4>
      					<p>'.$this->content->subtitle.'</p>
                <form action="'.$CFG->wwwroot.'/local/contact/index.php" method="post" class="contact_form" id="contact_form">
                   <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="name" id="namelabel">'.get_string('your_name', 'theme_edumy').'</label>
                          <input class="form-control" id="name" name="name" type="text" pattern="[A-zÀ-ž]([A-zÀ-ž\s]){2,}" title="'.get_string('your_name_requirements', 'theme_edumy').'" required="required" value="">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="email" id="emaillabel">'.get_string('email_address', 'theme_edumy').'</label>
                          <input id="email" name="email" type="email" required="required" title="'.get_string('email_address_requirements', 'theme_edumy').'" value="" class="form-control">
                       </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                          <label for="subject" id="subjectlabel">'.get_string('subject', 'theme_edumy').'</label>
                          <input id="subject" name="subject" type="text" maxlength="80" minlength="5" title="'.get_string('subject_requirements', 'theme_edumy').'" required="required" class="form-control">
                       </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                          <label for="message" id="messagelabel">'.get_string('message', 'theme_edumy').'</label>
                          <textarea id="message" name="message" rows="5" minlength="5" title="'.get_string('message_requirements', 'theme_edumy').'" required="required" class="form-control"></textarea>
                          <input type="hidden" id="sesskey" name="sesskey" value="">
                          <script>document.getElementById(\'sesskey\').value = M.cfg.sesskey;</script>
                        </div>
                        <div class="form-group ui_kit_button mb0">
                          <button type="submit" name="submit" id="submit" class="btn dbxshad btn-lg btn-thm circle white">'.get_string('send', 'theme_edumy').'</button>
                        </div>
                     <div>
                   </div>
                </form>
      				</div>
      			</div>
      		</div>
      	</section>
        <script>
        document.addEventListener(\'DOMContentLoaded\', function() {
        (function($){
        var MY_MAPTYPE_ID = \'style_KINESB\';

        function initialize() {
          var featureOpts = [
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#666666"
                    }
                ]
            },
            {
            "featureType": \'all\',
            "elementType": \'labels\',
            "stylers": [
                    { visibility: \'simplified\' }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#e2e2e2"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 45
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#aadaff"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            }
        ];
          var myGent = new google.maps.LatLng('.$this->content->map_lat.','.$this->content->map_lng.');
          var Kine = new google.maps.LatLng('.$this->content->map_lat.','.$this->content->map_lng.');
          var mapOptions = {
            zoom: 11,
            mapTypeControl: true,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.LEFT_TOP,
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
            },
            mapTypeId: MY_MAPTYPE_ID,
            scaleControl: false,
            streetViewControl: false,
            center: myGent
          }
          var map = new google.maps.Map(document.getElementById(\'map-canvas\'), mapOptions);
          var styledMapOptions = {
            name: \'style_KINESB\'
          };

        var image = \''.$map_marker_img.'\';
          var marker = new google.maps.Marker({
              position: Kine,
              map: map,
        animation: google.maps.Animation.DROP,
              title: \' '.$this->content->feature_1_subtitle.'  \',
        icon: image
          });

          var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
          map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

        }
        google.maps.event.addDomListener(window, \'load\', initialize);
      }(jQuery));
      }, false);
        </script>';
        return $this->content;
    }

    /**
     * Allow multiple instances in a single course?
     *
     * @return bool True if multiple instances are allowed, false otherwise.
     */
    public function instance_allow_multiple() {
        return true;
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return true;
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
     function applicable_formats() {
         return array(
           'all' => true,
           'my' => false,
         );
     }

}
