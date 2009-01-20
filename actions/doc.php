<?php

/**
 * Documentation action.
 *
 * PHP version 5
 *
 * @category Action
 * @package  Laconica
 * @author   Evan Prodromou <evan@controlyourself.ca>
 * @author   Robin Millette <millette@controlyourself.ca>
 * @license  http://www.fsf.org/licensing/licenses/agpl.html AGPLv3
 * @link     http://laconi.ca/
 *
 * Laconica - a distributed open-source microblogging tool
 * Copyright (C) 2008, Controlez-Vous, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('LACONICA')) {
    exit(1);
}

/**
 * Documentation class.
 *
 * @category Action
 * @package  Laconica
 * @author   Evan Prodromou <evan@controlyourself.ca>
 * @author   Robin Millette <millette@controlyourself.ca>
 * @license  http://www.fsf.org/licensing/licenses/agpl.html AGPLv3
 * @link     http://laconi.ca/


*/
class DocAction extends Action
{
    var $filename;
    var $title;

    /**
     * Class handler.
     * 
     * @param array $args array of arguments
     *
     * @return nothing
    */
    function handle($args)
    {
        parent::handle($args);
        $this->title    = $this->trimmed('title');
        $this->filename = INSTALLDIR.'/doc/'.$this->title;
        if (!file_exists($this->filename)) {
            $this->clientError(_('No such document.'));
            return;
        }
        $this->showPage();
    }

    /**
     * Display content.
     * 
     * @return nothing
    */
    function showContent()
    {
        $c      = file_get_contents($this->filename);
        $output = common_markup_to_html($c);
        $this->raw($output);
    }

    /**
     * Page title.
     * 
     * @return page title
    */
    function title()
    {
        return ucfirst($this->title);
    }
}

