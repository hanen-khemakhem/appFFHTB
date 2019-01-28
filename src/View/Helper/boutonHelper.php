<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \App\View\Helper\JavascriptHelper $Javascript
 * @property \App\View\Helper\AjaxHelper $Ajax
 */
class BoutonHelper extends Helper
{
    var $_button_tpl = '<button{params}><div class="ui-state-top-shadow ui-corner-top"></div><div class="ui-state-content">{label}</div></button>';

    var $helpers = array('Html', 'Javascript', 'Ajax');

    /**
     * Conserve le résultat de make pour le répéter rapidement grâce à $bouton::repeat (cas de boutons en haut et en bas de formulaire)
     */
    var $_make_cache;


    /**
     * Options par défaut de la fonction make
     */
    var $_default_make_options = array(
        'class' => 'ui-state-default ui-corner-all',
    );

    var $_default_block_options = array(
        'class' => 'buttonpane',
    );


    /**
     * Génère une div de boutons pour les formulaires
     * @param array $boutons
     * @param array $options
     * @return bool|string
     */
    function block($boutons = array(), $options = array())
    {
        # Merge des options par défaut avec les options indiquées
        $options = array_merge($this->_default_block_options, $options);

        $out = "";

        if (!is_array($boutons) || empty($boutons)) return false;

        foreach ($boutons as $key => $value) {
            if (is_numeric($key) && !is_array($value)) {
                $_function = $value;
                $_options = array();
                $_titre = null;

            } elseif (!is_numeric($key) && !is_array($value)) {
                $_function = $key;
                $_options = array();
                $_titre = $value;
            } elseif (!is_numeric($key) && is_array($value)) {
                $_function = $key;
                $_options = $value;
                $_titre = (isset($_options['titre']) ? $_options['titre'] : null);
            } else {
                $_function = 'add';
                $_options = $value;
                $_titre = (isset($_options['titre']) ? $_options['titre'] : null);
            }

            if (is_callable('BoutonHelper', $_function)) {
                $out .= $this->$_function($_titre, $_options);
            }
        }

        $out = $this->getView()->Html->tag('div', $out, ['class' => 'buttonpane']);

        $this->_make_cache = $out;

        return $out;
    }

    function repeat()
    {
        return $this->_make_cache;
    }

    function submit($titre = null, $options = array())
    {
        if (is_null($titre)) $titre = 'Valider';
        return $this->_make(array_merge(array('label' => $titre, 'type' => 'submit', 'image' => 'tick.gif'), $options));
    }

    function cancel($titre = null, $options = array())
    {
        if (is_null($titre)) $titre = 'Annuler';

        return $this->_make(array_merge(array('label' => $titre, 'image' => 'cross.gif'), $options));
    }

    function back($titre = null, $options = array())
    {
        if (is_null($titre)) $titre = 'Retour';
        if (!isset($options['action'])) $options['action'] = Configure::read('Referer');
        return $this->add($titre, $options);
    }

    function classique($titre, $options = array())
    {
        return $this->_make(array_merge($options, array('label' => $titre, 'defaultClass' => false)));
    }

    function blanc($titre, $options = array())
    {
        return $this->_make(array_merge($options, array('label' => $titre)));
    }

    function gris($titre, $options = array())
    {
        return $this->_make(array_merge($options, array('label' => $titre, 'style' => 'gris')));
    }

    function add($titre, $options = array())
    {
        return $this->_make(array_merge($options, array('label' => $titre)));
    }

    function _make($options)
    {
        $params = array();
        $postOut = '';

        if (isset($options['update'])) $options['type'] = 'ajax';
        elseif (!isset($options['type'])) $options['type'] = 'button';

        //verifier si le champ action existe
        if (isset($options['action']) && !empty($options['action'])) {
            if (is_array($options['action'])){
                $options['action'] = $this->getView()->Url->build($options['action']);
            }else{
                //verifier si le champ controller existe
                if (isset($options['controller']) && !empty($options['controller']))
                    $options['action'] = $options['controller'] . "/" . $options['action'];
                else {
                    $options['action'] = $this->request->getParam('controller') . "/" . $options['action'];
                }
                if (isset($options['field']) && !empty($options['field']))
                    $options['action'] .= "/" . $options['field'];
            }
        }

        if (in_array($options['type'], array('button', 'modal', 'ajax', 'closemodal')))
            $params['type'] = 'button';
        else
            $params['type'] = $options['type'];

        if (!isset($options['id'])) $options['id'] = 'button_' . md5(microtime());
        $params['id'] = $options['id'];

        if (isset($options['name']))
            $params['name'] = $options['name'];

        if (!isset($options['defaultClass']) || $options['defaultClass'] == false)
            $params['class'] = $this->_default_make_options['class'];
        else
            $params['class'] = '';

        if (isset($options['style']))
            $params['style'] = $options['style'];

        if (isset($options['class']))
            $params['class'] .= ' ' . $options['class'];

        if ($options['type'] == 'modal')
            $params['class'] .= ' modalbox';

        if (is_numeric(array_search('large', $options)))
            $params['class'] .= ' ui-state-large';

        if ($options['type'] == 'modal' || $options['type'] == 'ajax')
            $params['href'] = $this->_View->Html->Url->build($options['action'], true);
        elseif ($options['type'] == 'closemodal')
            $params['onclick'] = 'Modalbox.hide(); return false;';
        elseif (isset($options['onclick']))
            $params['onclick'] = $options['onclick'];
        elseif (isset($options['action'])) {
            $params['href'] = $this->_View->Html->Url->build($options['action']);

            if (isset($options['target']) && $options['target'] == '_blank')
                $params['onclick'] = 'window.open($(this).attr(\'href\'));';
            else {
                $params['onclick'] = 'document.location.href=$(this).attr(\'href\');';
            }
        }

        if (isset($options['confirm']) && isset($params['onclick'])) {
            $params['onclick'] = str_replace('$(this)', "$('#{$params['id']}')", $params['onclick']);
            $title = isset($options['title']) ? $options['title'] : 'Confirmation requise';
            $postOut .= '<div id="' . $params['id'] . '_confirmDialog" title="' . $title . '" style="display:none;">'
                . '<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'
                . $options['confirm']
                . '</p></div>';
            $js = <<<EOF
$(document).ready(function() {
    $("#{$params['id']}_confirmDialog").dialog({
		autoOpen: false,bgiframe: true,resizable: false,draggable:false,modal: true,
		buttons: {
			'Confirmer': function() {
				$(this).parent().find('.ui-dialog-buttonpane').addClass('loading');
				{$params['onclick']}
			},
			'Annuler': function() {
				$(this).dialog('close');
			}
		}
	});
	$("#{$params['id']}_confirmDialog").parent().find(".ui-dialog-buttonpane button:first").prepend('<img src="'+app_root+'img/tick.gif" alt=""/> ');
	$("#{$params['id']}_confirmDialog").parent().find(".ui-dialog-buttonpane button:last").prepend('<img src="'+app_root+'img/cross.gif" alt=""/> ');
});
EOF;
            $postOut .= $this->_View->Html->scriptBlock($js);
            $params['onclick'] = "$('#{$params['id']}_confirmDialog').dialog('open')";
        }

        if (isset($options['href']))
            $params['href'] = $this->_View->Html->Url->build($options['href']);

        if (isset($options['value']))
            $params['value'] = $options['value'];

        if (isset($options['title']))
            $params['title'] = $options['title'];

        if (isset($options['params']))
            $params['params'] = $options['params'];

        if (isset($options['rel']))
            $params['rel'] = $options['rel'];

        if (isset($options['image']))
            if (empty($options['label']))
                $options['label'] = '&nbsp;' . $this->_View->Html->image($options['image'], array('alt' => '', 'class' => 'no-text')) . $options['label'] . '&nbsp;';
            else
                $options['label'] = $this->_View->Html->image($options['image'], array('alt' => '')) . $options['label'];


        $inline_params = "";
        foreach ($params as $k => $v) {
            $inline_params .= ' ' . $k . '="' . $v . '"';
        }
        $out = str_replace('{params}', $inline_params, $this->_button_tpl);
        $out = str_replace('{label}', $options['label'], $out);

        if ($options['type'] == 'ajax') {
            if (!isset($options['url'])) $options['url'] = $options['action'];
            $options['before'] = "onStartAjaxUpdate('{$options['update']}')";
            $options['complete'] = "onFinishAjaxUpdate('{$options['update']}')";
            $out .= $this->Javascript->event("'{$options['id']}'", "click", $this->_View->Ajax->remoteFunction($options));
        }

        $out .= $postOut;

        return $out;
    }
}