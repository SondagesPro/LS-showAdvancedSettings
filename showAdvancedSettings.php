<?php
/**
 * showAdvancedSettings Plugin for LimeSurvey
 *
 * @author Denis Chenu <http://sondages.pro>
 *
 * @copyright 2015 Denis Chenu <http://sondages.pro>
 * @license AGPL v3 ( GNU AFFERO GENERAL PUBLIC LICENSE )
 * @version 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with showAdvancedSettings.  If not, see <http://www.gnu.org/licenses/>.
 */
class showAdvancedSettings extends PluginBase {
  protected $storage = 'DbStorage';
  static protected $name = 'showAdvancedSettings';
  static protected $description = 'Show advanced settings by default when editing a question.';

  public function __construct(PluginManager $manager, $id)
  {
    parent::__construct($manager, $id);
    $this->subscribe('afterPluginLoad');
  }
  public function afterPluginLoad()
  {
    // Control if we are in an admin page, register everywhere even is not needed
    $oRequest=$this->pluginManager->getAPI()->getRequest();
    $sController=Yii::app()->getUrlManager()->parseUrl($oRequest);
    if(substr($sController, 0, 5)=='admin')
      $this->registerNeededScript();
  }
  /**
  * Register the javascript file needed to show advanced questio setings by default
  * @return void
  */
  private function registerNeededScript()
  {
    App()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/show-advanced-settings.js'));
  }
}
