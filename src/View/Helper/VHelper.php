<?php
/**
 * View helper complements
 * @author florent@bissiriex.fr
 */

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Routing\Router;
use Cake\Utility\Inflector;
use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use Cake\View\View;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \App\View\Helper\JavascriptHelper $Javascript
 * @property \App\View\Helper\AjaxHelper $Ajax
 * @property \Cake\View\Helper\FormHelper $Form
 * @property \Cake\View\Helper\NumberHelper $Number
 */
class VHelper extends Helper
{
    var $helpers = array('Html', 'Javascript', 'Ajax', 'Form', 'Number');

    /**
     * function echo avec valeur par défaut si null
     *
     * @param <type> $text
     * @param <type> $default
     */
    function e(&$text = null, $default = null)
    {
        if (!isset($text) || $text == null)
            echo $default;
        else
            echo $text;
    }

    function euro($number = 0, $options = array())
    {
        if (is_string($options))
            $options = array($options);

        $after = ' &#8364;';

        $onlyCentimes = (abs($number) < 1 && abs($number) > 0);
        $negative = ($number < 0);

        if (in_array('kilo', $options, true)) {
            if ($number >= 1000) {
                $after = ' K&#8364;';
                $number /= 1000;
            }
        }

        if (in_array('round', $options, true)) {
            $number = round($number);
        }

        $number = $this->getView()->Number->currency($number, 'EUR', array(
            'locale' => 'tn_TN'
        ));

        if ($onlyCentimes)
            $number = '0,' . $number;

        if (in_array('short', $options, true)) {
            $number = str_replace(",00", '', $number);
        }

        if (in_array('colored', $options, true)) {
            if (in_array('inverse', $options, true))
                $color = $number < 0 ? 'vert' : 'rouge';
            else
                $color = $number >= 0 ? 'vert' : 'rouge';
            $number = "<span class='$color'>" . $number . "</span>";
        }

        return $number;
    }

    function taux($cout, $taux)
    {
        $ajout = $cout / 100 * $taux;
        $cout += $ajout;
        return $cout;
    }

    function input($fieldName, $options = array())
    {

        if ($options == 'hidden' || $fieldName == 'id')
            $options = array('type' => 'hidden');

        if (isset($options['class']))
            $options['class'] .= ' ui-widget-content ui-corner-all';
        else
            $options['class'] = 'ui-widget-content ui-corner-all';

        if (in_array('disabled', $options, true)) {
            $options['disabled'] = 'disabled';
            $options['class'] .= ' ui-state-disabled';
        }

        if (in_array('4cols', $options, true))
            $options['div']['class'] = 'oneQuartWidth';
        if (in_array('3cols', $options, true))
            $options['div']['class'] = 'oneTierWidth';
        if (in_array('2cols', $options, true))
            $options['div']['class'] = 'halfWidth';

        if (isset($options['after']) && is_array($options['after']))
            $options['after'] = implode('', $options['after']);

        if (isset($options['type']) && $options['type'] == 'datepicker')
            $out = $this->_inputDate($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'color')
            $out = $this->_inputColor($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'fcbkcomplete')
            $out = $this->_inputFcbkcomplete($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'wysiwyg')
            $out = $this->_inputWysiwyg($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'onoff')
            $out = $this->_inputOnOff($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'asmselect')
            $out = $this->_inputAsmSelect($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'money')
            $out = $this->_inputMoney($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'stars')
            $out = $this->_inputStars($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'chosen')
            $out = $this->_inputChosen($fieldName, $options);
        elseif (isset($options['type']) && $options['type'] == 'multipleCheckbox')
            $out = $this->_inputMultipleCheckbox($fieldName, $options);
        else
            $out = $this->getView()->Form->control($fieldName, $options);

        if (isset($options['div']['style']) && !empty($options['div']['style']))
            $style = $options['div']['style'];
        else
            $style = "";

        if (isset($options['div']['id']) && !empty($options['div']['id']))
            $id = $options['div']['id'];
        else
            $id = "";

        if (isset($options['div']['class']) && !empty($options['div']['class']))
            $class = $options['div']['class'];
        else
            $class = "";

        if (isset($options['after']) && !empty($options['after']))
            $out .= $options['after'];

        if (isset($options['div']) && !empty($options['div']))
            $out = '<div id="' . $id . '" class="' . $class . '" style="' . $style . '" >' . $out . "</div>";

        return $out;
    }

    function _inputDate($fieldName, $options = array())
    {
        if (empty($options['value'])) {

            $val = $this->getView()->Form->getSourceValue($fieldName);
            if (empty($val))
                $options['value'] = date('Y-m-d');
            else
                $options['value'] = $val;
        }

        $options2 = $options;
        $options['type'] = 'text';
        if (isset($options['class'])) $options['class'] .= ' ui-widget-date';
        else $options['class'] = 'ui-widget-date';


        $options2['value'] = $options['value'] = date('Y-m-d', strtotime($options['value']));
        $options2['type'] = 'hidden';
        $options2['class'] = null;

        $out = $this->getView()->Form->control($fieldName, $options);
        $out .= $this->getView()->Form->control($fieldName, $options2);

        return $out;
    }

    function _inputMoney($fieldName, $options = array())
    {
        if (empty($options['value']))
            $options['value'] = '0.00';

        $options['type'] = 'text';

        if (isset($options['class'])) $options['class'] .= ' ui-widget-euro';
        else $options['class'] = 'ui-widget-euro';

        $out = $this->Form->control($fieldName, $options);
        $this->Html->script('form.money', ['block' => 'scriptBottom']);

        return $out;
    }

    function _inputMultipleCheckbox($fieldName, $options = array())
    {
        $options = $this->Form->_initInputField($fieldName, $options);

        if (empty($options['div']))
            $options['div'] = array();

        $out = $this->Html->div(null, null, $options['div']);
        unset($options['div']);
        $out .= $this->Form->label($fieldName, $options['label']);
        $out .= $this->Html->div('ui-widget-content ui-corner-all input-multipleCheckbox', null);
        unset($options['label'], $options['class']);

        $count = 0;

        $out .= "<ul class='multipleCheckbox'>";
        foreach ($options['options'] as $key => $opt) {
            if (is_array($opt)) {
                $id = uniqid();
                $out .= "<li class='multipleCheckboxGroup'>";
                $out .= $this->Form->checkbox("null.null", array('id' => $id, 'name' => null, 'hiddenField' => false));
                $out .= "<label for='$id'><strong>" . $key . "</strong></label>";
                $out .= "<ul>";
                foreach ($opt as $k => $o) {
                    $id = uniqid();
                    $out .= "<li>";
                    $out .= $this->Form->checkbox($fieldName . '.' . $k, array('id' => $id, 'value' => $k, 'hiddenField' => false));
                    $out .= "<label for='$id'>" . $o . "</label>";
                    $out .= "</li>";
                    $count++;
                }
                $out .= "</ul>";
                $out .= "</li>";
            } else {
                $id = uniqid();
                $out .= "<li>";
                $out .= $this->Form->checkbox($fieldName . '.' . $key, array('id' => $id));
                $out .= "<label for='$id'>" . $o . "</label>";
                $out .= "</li>";
                $count++;
            }
        }
        $out .= "</ul>";

        $out .= '</div>';
        $out .= '</div>';
        $this->Javascript->link('form.multipleCheckbox', false);
        //$this->Html->css('jquery.rating',null,array('inline'=>false));

        return $out;
    }

    function _inputStars($fieldName, $options = array())
    {
        die("appeler wissem");
        $options = $this->Form->_initInputField($fieldName, $options);

        if (empty($options['value']))
            $options['value'] = $this->Form->value($fieldName);

        if (isset($options['max'])) {
            $max = $options['max'];
            unset($options['max']);
        } else
            $max = 5;

        if (empty($options['div']))
            $options['div'] = array();

        $currentValue = $options['value'];

        $out = $this->Html->div(null, null, $options['div']);
        unset($options['div']);
        $out .= $this->Form->label($fieldName, $options['label']);
        $out .= $this->Html->div('ui-widget-content ui-corner-all input-stars', null);

        unset($options['label'], $options['class']);

        $optTitle = "";
        $options['value'] = 0;
        $parsedOptions = $this->_parseAttributes(
            $options,
            array('name', 'type', 'id'), '', ' '
        );
        $out .= sprintf(
            $this->Html->tags['hidden'], $options['name'], $parsedOptions
        );

        $options['class'] = 'star';

        for ($i = 1; $i <= $max; $i++) {
            $options['value'] = $i;
            if ($currentValue == $i)
                $options['checked'] = 'checked';
            else
                unset($options['checked']);

            $parsedOptions = $this->_parseAttributes(
                $options,
                array('name', 'type', 'id'), '', ' '
            );

            $tagName = Inflector::camelize(
                $options['id'] . '_' . Inflector::slug($i)
            );

            $out .= sprintf(
                $this->Html->tags['radio'], $options['name'],
                $tagName, $parsedOptions, $optTitle
            );
            //<input type="radio" name="%s" id="%s" %s />%s
        }
        $out .= '</div>';
        $out .= '</div>';

        $this->Html->script('libs/jquery.rating.pack', ['block' => 'scriptBottom']);
        $this->Html->css('jquery.rating', array('inline' => false));

        return $out;
    }


    function _inputFcbkcomplete($fieldName, $options = array())
    {
        if (!isset($options['id'])) {
            $view = $this->getView();
            $entity = join('_', explode('.', $fieldName));
            $options['id'] = Inflector::camelize($entity);
        }

        $options['type'] = 'select';
        $options['multiple'] = 'true';
        if (isset($options['values']) && is_array($options['values'])) {
            $options['options'] = $options['values'];
            $options['selected'] = array_keys($options['values']);
            unset($options['values']);
        }

        $out = $this->Form->control($fieldName, $options);
        $this->Html->script('libs/jquery.fcbkcomplete', ['block' => 'scriptBottom']);

        if (!isset($options['fcbkcomplete'])) $options['fcbkcomplete'] = array();
        $options['fcbkcomplete'] = array_merge(array(
            'json_url' => null,
            'cache' => false,
            'filter_case' => false,
            'filter_hide' => true,
            'firstselected' => true,
            'filter_selected' => true,
            'newel' => true,
            'complete_text' => ''
        ), $options['fcbkcomplete']);

        $fcbkOption = json_encode($options['fcbkcomplete']);


        $js = <<<EOF
$(document).ready(function(){
  $("#{$options['id']} option").addClass('selected');
  $("#{$options['id']}").fcbkcomplete({$fcbkOption});
});
EOF;
        unset($options['url']);
        unset($options['fcbkcomplete']);
        $out .= $this->Html->scriptBlock($js, ['block' => 'scriptBottom']);

        echo $this->Html->css('fcbkcomplete', array('inline' => false));
        return $out;
    }


    function _inputColor($fieldName, $options = array())
    {
        if (empty($options['value'])) {
            $options['value'] = '#ffffff';
        }
        $options['type'] = 'text';
        $options['class'] = 'ui-colorpicker';
        $options['style'] = 'background-color:' . $options['value'];

        $out = $this->Form->control($fieldName, $options);
        $this->Html->script('libs/farbtastic', ['block' => 'scriptBottom']);
        $this->Html->script('form.colorpicker', ['block' => 'scriptBottom']);
        $this->Html->css('farbtastic', array('inline' => false));
        return $out;
    }

    function _inputAsmSelect($fieldName, $options = array())
    {
        $options['type'] = 'select';
        $options['class'] = 'asmselect';
        $options['multiple'] = true;

        if (!isset($options['title']) || empty($options['title']))
            $options['title'] = '';

        if (in_array('sortable', $options, true))
            $options['class'] = 'asmselectsortable';

        $out = $this->getView()->Form->control($fieldName, $options);
        $this->getView()->Html->script('libs/jquery.asmselect', ['block' => 'scriptBottom']);
        $this->getView()->Html->script('form.asmselect', ['block' => 'scriptBottom']);
        $this->getView()->Html->css('jquery.asmselect', array('inline' => false, 'block' => true));
        return $out;
    }

    function _inputChosen($fieldName, $options = array())
    {
        if (!isset($options['id'])) {
            $entity = explode(".", $fieldName);
            $entity = implode('_', $entity);
            $options['id'] = Inflector::camelize($entity);

        }

        if (in_array('multiple', $options, true))
            $options['multiple'] = 'multiple';

        if (isset($options['title']))
            $options['data-placeholder'] = $options['title'];

        $options['type'] = 'select';

        $this->getView()->Html->script('libs/chosen.jquery.min', ['block' => 'scriptBottom']);
        $this->getView()->Html->css('chosen', array('inline' => false, 'block' => true));

        $this->getView()->Html->scriptBlock('$("#' . $options['id'] . '").chosen();', ['block' => 'scriptBottom']);

        $out = $this->getView()->Form->control($fieldName, $options);

        return $out;
    }

    function _inputOnOff($fieldName, $options = array())
    {
        if (!isset($options['id'])) {
            $entity = explode(".", $fieldName);
            $entity = join('_', $entity);
            $options['id'] = Inflector::camelize($entity);
        }

        $options['type'] = 'select';

        if (!isset($options['options']))
            $options['options'] = array(1 => "Oui", 0 => "Non");

        $options['class'] = 'switchBox';

        if (!isset($options['default']))
            $options['default'] = 0;

        $out = $this->getView()->Form->control($fieldName, $options);
        $this->Html->script('libs/jquery.switch.min', ['block' => 'scriptBottom']);
        $this->Html->script('form.iphoneCheckbox', ['block' => 'scriptBottom']);
        $this->Html->css('jquery.switch', array('inline' => false, 'block' => true));
        return $out;
    }

    function _inputWysiwyg($fieldName, $options = array())
    {
        if (!isset($options['id'])) {
            $entity = explode(".", $fieldName);
            $entity = implode('_', $entity);
            $options['id'] = Inflector::camelize($entity);

        }
        $options['type'] = 'textarea';
        $this->getView()->Html->script('libs/tiny_mce/tiny_mce', ['block' => 'scriptBottom']);

        if (!isset($options['options']))
            $options['options'] = array();

        if (in_array('lite', $options, true)) {
            $tinyMceOptions = array_merge(array(
                'theme' => 'advanced',
                'skin' => 'o2k7',
                'mode' => 'exact',
                'elements' => $options['id'],
                'convert_urls' => false,
                'theme_advanced_toolbar_location' => 'top',
                'theme_advanced_toolbar_align' => 'left',
                'theme_advanced_statusbar_location' => false,
                'theme_advanced_resizing' => false,
                'theme_advanced_resize_horizontal' => 0,
                'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,forecolor,backcolor,|,bullist,numlist,|,link,unlink,|,cleanup,removeformat,|,code",
                'theme_advanced_buttons2' => '',
                'theme_advanced_buttons3' => '',
                'plugins' => 'noneditable,inlinepopups,example,paste',
                'dialog_type' => "modal"
            ), $options['options']);
        } elseif (in_array('mail', $options, true)) {
            $tinyMceOptions = array_merge(array(
                'theme' => 'advanced',
                'skin' => 'o2k7',
                'mode' => 'exact',
                'elements' => $options['id'],
                'convert_urls' => false,
                'theme_advanced_toolbar_location' => 'top',
                'theme_advanced_toolbar_align' => 'left',
                'theme_advanced_statusbar_location' => 'bottom',
                'theme_advanced_resizing' => true,
                'theme_advanced_resize_horizontal' => 0,
                'theme_advanced_buttons1' => "psyclickFields,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,forecolor,backcolor,|,bullist,numlist,|,outdent,indent",
                'theme_advanced_buttons2' => "undo,redo,|,link,unlink,anchor,image,code,media,youtube|,sub,sup,|,charmap,|,cleanup,removeformat,|,hr,visualaid",
                'theme_advanced_buttons3' => '',
                'plugins' => 'noneditable,inlinepopups,example,paste,media',
                "extended_valid_elements" => "iframe[src|title|width|height|allowfullscreen|frameborder]",
                'dialog_type' => "modal"
            ), $options['options']);
        } elseif (isset($options["image"])) {

            $tinyMceOptions = array_merge(array(
                'theme' => 'advanced',
                'skin' => 'o2k7',
                'mode' => 'exact',
                'elements' => $options['id'],
                'convert_urls' => false,
                'theme_advanced_toolbar_location' => 'top',
                'theme_advanced_toolbar_align' => 'left',
                'theme_advanced_statusbar_location' => 'bottom',
                'theme_advanced_resizing' => true,
                'theme_advanced_resize_horizontal' => 0,
                'theme_advanced_buttons1' => "psyclickFields,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,forecolor,backcolor,|,bullist,numlist,|,outdent,indent|,image,|,code,|,media,|,",
                'theme_advanced_buttons2' => "",
                'theme_advanced_buttons3' => '',
                'dialog_type' => "modal"
            ), $options['options']);
        } else {

            $tinyMceOptions = array_merge(array(
                'theme' => 'advanced',
                'skin' => 'o2k7',
                'mode' => 'exact',
                'elements' => $options['id'],
                'convert_urls' => false,
                'theme_advanced_toolbar_location' => 'top',
                'theme_advanced_toolbar_align' => 'left',
                'theme_advanced_statusbar_location' => 'bottom',
                'theme_advanced_resizing' => true,
                'theme_advanced_resize_horizontal' => 0,
                #'theme_advanced_toolbar_location'=>'external',
                'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,cleanup,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,code",
                #'theme_advanced_buttons1'=>"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,hr,removeformat,visualaid,|,sub,sup,|,charmap",
                'theme_advanced_buttons2' => '',
                'theme_advanced_buttons3' => '',

            ), $options['options']);
        }

        $code = '';
        if (in_array('delayed', $options, true)) {
            $tinyMceOptions['mode'] = 'none';
            $tinyMceOptions['init_instance_callback'] = $options['id'] . '_mceFocus';
            $code .= 'function ' . $options['id'] . '_mceAddControl(){
				' . $options['id'] . '_mceInit();
				tinyMCE.execCommand("mceAddControl",' . json_encode($tinyMceOptions) . ',"' . $options['id'] . '");
			}
			function ' . $options['id'] . '_mceFocus(){
				tinyMCE.execInstanceCommand("' . $options['id'] . '", "mceFocus");
			}
			function ' . $options['id'] . '_mceRemoveControl(){
				tinyMCE.execCommand("mceRemoveControl",false,"' . $options['id'] . '");
				tinyMCE.triggerSave();
			}
			function ' . $options['id'] . '_mceInit(){
				tinyMCE.init(' . json_encode($tinyMceOptions) . ');
			}
			function ' . $options['id'] . '_mceSetContent(){
				tinyMCE.execCommand("mceSetContent", "' . $options['id'] . '" ,"");
			}';
        } else
            $code .= 'tinyMCE.init(' . json_encode($tinyMceOptions) . ');';

        $out = $this->getView()->Form->control($fieldName, $options);
        $out .= $this->getView()->Html->scriptBlock($code, ['block' => 'scriptBottom']);
        return $out;
    }


    function separator($options = array())
    {
        return $this->Html->div('separator', '', $options);
    }

    function newline($options = array())
    {
        return $this->Html->div('clear', '', $options);
    }

    /**
     * Affichage "human friendly" d'un boolean
     * @param any $value
     * @return string : Oui / Non
     */
    function ouinon($value)
    {
        return $value ? __('Oui', true) : __('Non', true);
    }

    function tag($text, $color = 'bleu', $attributes = array())
    {
        if (is_array($color)) {
            $attributes = $color;
            if (isset($attributes['color']))
                $color = $attributes['color'];
            else
                $color = null;
        }

        switch ($color) {
            case 'rouge':
                $attributes += array('style' => 'background:#DF1B35');
                break;
            case 'violet':
                $attributes += array('style' => 'background:#9966CC');
                break;
            case 'gris':
                $attributes += array('style' => 'background:#ADADAD');
                break;
            case 'vert':
                $attributes += array('style' => 'background:#4AA93D');
                break;
            case 'rose':
                $attributes += array('style' => 'background:#FF5FB1');
                break;
            case null:
            case 'bleu':
                break;
            default:
                $attributes = array('style' => 'background:' . $color);
        }

        $escape = isset($options['escape']) ? $options['escape'] : false;
        $attributes['class'] = isset($attributes['class']) ? $attributes['class'] . ' tag' : 'tag';
        return $this->Html->tag('div', $text, $attributes, $escape);
    }

    function stars($value, $max, $min = 0, $color = null)
    {
        $image = 'star.gif';
        if ($color != null)
            $image = 'star_' . $color . '.gif';

        $out = "";
        for ($i = $min; $i < $max; $i++) {
            $out .= ($i < $value) ? $this->Html->image($image) : $this->Html->image('star_silver.gif');
        }
        return $out;
    }

    /**
     * Fonction getRelativeDate
     * par Jay Salvat - http://blog.jaysalvat.com/
     * @param $date
     * @param array $options
     * @return string
     */
    function getRelativeDate($date, $options = array())
    {
        // Les paramètres locaux sont basés sur la France
        setlocale(LC_TIME, "fra");

        // On prend divers points de repère dans le temps
        $time = strtotime($date);
        $after = strtotime("+7 day 00:00");
        $afterTomorrow = strtotime("+2 day 00:00");
        $tomorrow = strtotime("+1 day 00:00");
        $today = strtotime("today 00:00");
        $yesterday = strtotime("-1 day 00:00");
        $beforeYesterday = strtotime("-2 day 00:00");
        $before = strtotime("-7 day 00:00");

        // On compare les repères à la date actuelle
        // si elle est proche alors on retourne une date relative...
        if ($time < $after && $time > $before) {
            if ($time >= $after) {
                $relative = strftime("%A", $date) . " prochain";
            } else if ($time >= $afterTomorrow) {
                $relative = "après demain";
            } else if ($time >= $tomorrow) {
                $relative = "demain";
            } else if ($time >= $today) {
                if (!in_array('short', $options, true))
                    $relative = "aujourd'hui";
                else
                    $relative = utf8_encode(strftime("%d %b", $time));
            } else if ($time >= $yesterday) {
                $relative = "hier";
            } else if ($time >= $beforeYesterday && !in_array('short', $options, true)) {
                $relative = "avant hier";
            } else if ($time >= $before) {
                $relative = strftime("%A", $time);
                if (!in_array('short', $options, true))
                    $relative .= " dernier";
            }
        } elseif (in_array('short', $options, true)) {
            $relative = utf8_encode(strftime("%d %b", $time));
        } else {
            // sinon on retourne une date complète.
            $relative = 'le ' . utf8_encode(strftime("%A %d %B %Y", $time));
        }

        // si l'heure est présente dans la date originale, on l'ajoute
        if (isset($relative))
            $relative .= ' à ' . date('H:i', $time);
        else
            $relative = 'à ' . date('H:i', $time);

        return $relative;
    }

    function renderView($name, $data = array(), $params = array(), $loadHelpers = false)
    {
        $view = $this->getView();
        foreach ($data as $key => $value) {
            $view->set($key, $value);
        }
        return $view->element('..' . DS . $name, $params, ['helpers' => $loadHelpers]);
    }

    function date($format, $date = null)
    {
        $jours = array(
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',

            'Mon' => 'lun',
            'Tue' => 'mar',
            'Wed' => 'mer',
            'Thu' => 'jeu',
            'Fri' => 'ven',
            'Sat' => 'sam',
            'Sun' => 'dim',

            'January' => 'Janvier',
            'February' => 'Février',
            'March' => 'Mars',
            'April' => 'Avril',
            'May' => 'Mai',
            'June' => 'Juin',
            'July' => 'Juillet',
            'August' => 'Août',
            'September' => 'Septembre',
            'October' => 'Octobre',
            'November' => 'Novembre',
            'December' => 'Décembre',

            'Feb' => 'Fév',
            'Apr' => 'Avr',
            'Jun' => 'Jui',
            'Aug' => 'Aoû',
            'Dec' => 'Déc',
        );
        if ($date == null) $date = time();
        if (is_string($date)) $date = strtotime($date);
        if (is_object($date)) $date = strtotime($date);
        $date = date($format, $date);
        $date = str_replace(array_keys($jours), array_values($jours), $date);
        return $date;
    }

    /**
     * Pagination améliorée
     *
     * Usage : $v->paginate($paginator);
     * @param Object $paginator : Instance du paginator
     * @param String $name : Nom à afficher dans (500 $name enregistrés)
     */
    function paginate($paginator, $name = null)
    {
        if ($name == null)
            $name = $this->getView()->request->getParam('controller');


        $pageCount = $paginator->params()['pageCount'];
        $currentPage = $paginator->params()['page'];

        $paginator->setTemplates([
            'number' => '<span><a href="{{url}}">{{text}}</a></span>&nbsp;',
            'current' => '<span class="current">{{text}}</span>',
            'nextActive' => '<span><a class="next" href="{{url}}">{{text}}</a></span>',
            'nextDisabled' => '<span class="next disabled">{{text}}</span>',
            'prevActive' => '<span><a class="previous" href="{{url}}">{{text}}</a></span>',
            'prevDisabled' => '<span class="previous disabled">{{text}}</span>',
            'last' => '<span class="more">...</span><span><a href="{{url}}">' . $pageCount . '</a></span>',
            'first' => '<span><a href="{{url}}">1</a></span><span class="more">...</span>'
        ]);

        echo '<div class="paging">';
        echo $paginator->prev('&laquo; préc.', array('escape' => false, 'class' => 'previous'), null, array('escape' => false, 'class' => 'previous disabled'));

        if ($currentPage > 5 && $pageCount > 9)
            echo $paginator->first();

        echo $paginator->numbers(array('modulus' => 8));

        if ($currentPage < $pageCount - 5 && $pageCount > 9)
            echo $paginator->last();

        echo $paginator->next('suiv. &raquo;', array('escape' => false, 'class' => 'next'), null, array('escape' => false, 'class' => 'next disabled'));
        echo $paginator->counter(array('format' => '<p>({{count}} ' . $name . ' enregistrés)</small></p>'));
        echo '</div>';
    }

    /**
     * Pagination spécifique
     * @param string $model
     * @param bool $feminin
     * @return string
     */
    function pagination($model = 'éléments', $feminin = false)
    {
        $pagination = Configure::Read('Pagination');
        $html = '<div class="paging">';

        if (isset($pagination['page']) && $pagination['page'] < 2)
            $html .= '<span class="previous disabled">« préc.</span>&nbsp;'
                . '<span class="current">1</span>&nbsp;';
        else
            $html .= '<span>' . $this->link('« préc.', $this->_paginationUrl($pagination['pages'] - 1), array('class' => 'previous')) . '</span>&nbsp;'
                . '<span>' . $this->link('1', $this->_paginationUrl(1)) . '</span>&nbsp;';

        $startPage = 2;
        $endPage = $pagination['pages'] - 1;
        if ($pagination['pages'] > 6 && $pagination['pages'] > 9) {
            $startPage = $pagination['pages'] - 4;
            $html .= $this->Html->tag('span', '...', array('class' => 'more')) . '&nbsp;';
            if ($startPage > $pagination['pages'] - 8)
                $startPage = $pagination['pages'] - 8;
        }
        if ($pagination['pages'] < $pagination['pages'] - 5 && $pagination['pages'] > 9) {
            $endPage = $pagination['pages'] + 4;
            if ($endPage < 9)
                $endPage = 9;
        }

        for ($page = $startPage; $page <= $endPage; $page++) {
            if ($page == $pagination['pages'])
                $html .= $this->Html->tag('span', $page, array('class' => 'current')) . '&nbsp;';
            else
                $html .= '<span>' . $this->link($page, $this->_paginationUrl($page)) . '</span>&nbsp;';
        }

        if ($pagination['pages'] < $pagination['pages'] - 5 && $pagination['pages'] > 9) {
            $html .= $this->Html->tag('span', '...', array('class' => 'more')) . '&nbsp;';
        }

        if ($pagination['pages'] > 1)
            if ($pagination['pages'] >= $pagination['pages'])
                $html .= '<span class="current">' . $pagination['pages'] . '</span>&nbsp;'
                    . '<span class="next disabled">suiv. »</span>';
            else
                $html .= '<span>' . $this->link($pagination['pages'], $this->_paginationUrl($pagination['pages'])) . '</span>&nbsp;'
                    . '<span>' . $this->link('suiv. »', $this->_paginationUrl($pagination['pages'] + 1), array('class' => 'next')) . '</span>';
        else
            $html .= '<span class="next disabled">suiv. »</span>';

        $html .= "<p>(" . $pagination['total'] . " $model enregistré" . ($feminin ? "e" : "") . "s)</p>";

        $html .= '</div>';
        return $html;
    }

    function _paginationUrl($page)
    {
        $url = Router::parseRequest($this->request);
        $url['?']['page'] = $page;
        unset($url['url']['ext']);
        return Router::reverse($url);
    }


    function trim($text)
    {
        $text = trim($text);
        $text = preg_replace('/(\n|\r|<p>\&nbsp\;<\/p>)*$/i', '', $text);
        $text = preg_replace('/^(\n|\r|<p>\&nbsp\;<\/p>)*/i', '', $text);
        return $text;
    }

    function link($title, $url = null, $htmlAttributes = array(), $confirmMessage = false, $escapeTitle = false, $return = false)
    {

        if (isset($htmlAttributes['image'])) {
            $htmlAttributes['escape'] = 1;
            if (isset($htmlAttributes['img']))
                $imageOptions = array_merge(array('alt' => ''), $htmlAttributes['img']);
            else
                $imageOptions = array('alt' => '');
            $title = $this->Html->image($htmlAttributes['image'], $imageOptions) . " " . $title;

            unset($htmlAttributes['image']);
        }

        if (in_array('post', $htmlAttributes) && !$confirmMessage) {
            $htmlAttributes['onclick'] = "var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href; f.submit(); return false;";
        }

        if ($confirmMessage) {
            $confirmMessage = str_replace("'", "\'", $confirmMessage);
            $confirmMessage = str_replace('"', '\"', $confirmMessage);
            //on ajout le post
            $htmlAttributes['onclick'] = "if (confirm(‘$confirmMessage ’)) { var f = document.createElement(‘form’); f.style.display = ‘none’; this.parentNode.appendChild(f); f.method = ‘post’; f.action = this.href;f.submit(); };return false;";
        }

        if (in_array('noMiddleClick', $htmlAttributes)) {
            if (isset($htmlAttributes['onclick']))
                $htmlAttributes['onclick'] .= ";return false;";
            else
                $htmlAttributes['onclick'] = "return false;";
        }

        //Et on utilise l’helper de base
        $output = $this->Html->link($title, $url, array_merge(['escapeTitle' => $escapeTitle, 'confirm' => $confirmMessage], $htmlAttributes));
        return $this->output($output);
    }

    function theadFloat()
    {
        echo $this->Html->script(array('libs/jquery.thfloat-0.3.min'));
        $this->Html->scriptStart(['block' => true]);
        echo '$(function() { $(".listeNoJs").thfloat(); });';
        $this->Html->scriptEnd();
    }


    function image($image, $options = array())
    {
        if (!empty($image))
            return $this->Html->image($image, $options);
        else
            return '';
    }

    function img($image, $options = array())
    {
        return $this->image($image, $options);
    }

    /**
     * Returns a string generated by a helper method
     *
     * This method can be overridden in subclasses to do generalized output post-processing
     *
     * @param string $str String to be output.
     * @return string
     */
    function output($str)
    {
        return $str;
    }
}