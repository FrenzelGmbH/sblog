<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace frenzelgmbh\sblog;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class sblogAsset extends AssetBundle
{
    public $sourcePath = '@frenzelgmbh/sblog/assets';
    
    public $css = [
        'css/sblog.css'
    ];
    
    public $js = [];
    
    public $depends = [];
}
