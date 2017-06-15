<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<?php if ($this->direction == 'rtl') : ?>
	<?php endif; ?>
  <style type="text/css">
body {color: black; background: white; font: 10pt/1.4 Helvetica, Arial, sans-serif, Verdana; margin:20px; max-width:600px;}
a { outline:none; }
a:link {color: black; text-decoration: underline;}
a:hover, a:active, a:focus  {color: red; text-decoration: underline;}
a:visited {color: grey; text-decoration:none; }
fieldset {margin:0; padding:0;border:0;}
input, inputbox {border: none;  background: #FFFFFF}
  </style>
</head>
<body>
<jdoc:include type="message" />
		<div style="text-align:left"><b><?php echo htmlspecialchars($app->getCfg('sitename')); ?></b><br /><br />
	<?php if ($app->getCfg('display_offline_message', 1) == 1 && str_replace(' ', '', $app->getCfg('offline_message')) != ''): ?>
			<?php echo $app->getCfg('offline_message'); ?>
	<?php elseif ($app->getCfg('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != ''): ?>
			<?php echo JText::_('JOFFLINE_MESSAGE'); ?>
	<?php  endif; ?><br /><br />
In the meantime, visit us on <a href="https://www.facebook.com/pages/Experimental-Jetset/225316069159" target="blank">Facebook</a>,<br />
or <script type="text/javascript">
//<![CDATA[
<!--
var x="function f(x,y){var i,o=\"\",l=x.length;for(i=0;i<l;i++){if(i<104)y++" +
";y%=127;o+=String.fromCharCode(x.charCodeAt(i)^(y++));}return o;}f(\"\\017\\"+
"036\\003\\014\\005\\032\\032\\031Y\\035Ux+\\177pix,g<})4:6sr\\035Z\\nJMDKZX" +
"\\036X\\013WV\\007I(+(#`2b-83&\\0257>9\\037\\024J\\010IYYEOMFL_\\003\\016\\" +
"016\\007z{.:q0a$,\\177.jzzi|I\\013@\\016RVPI^A\\035^\\004V\\026\\r\\006W\\0" +
"01}qy*iho<'bw3b.&.\\\"\\020&{=|m**<...3~0N\\022\\027\\001\\027\\021\\024OXE" +
"\\005\\007EV\\023\\tXS[GLY*U917&,3I11^_GSt[T=8;PQ?? MN}HIV\\\"'*..vm*.\\020" +
"}~O\\024\\027\\026{t^\\007\\001\\034\\006\\032\\031\\003\\001no\\002\\006\\" +
"006kd_nc\\016\\016\\016c\\034\\007\\027\\036\\034\\n\\004!\\003\\r\\004<pm9" +
"-(*#0z\\003c79)2\\006nnn\\003<$7>QVV;4\\\\Y[01\\0003,@AC()DGH%&HOM\\\"\\\\1" +
"03XYM0:9VW;<>SL+\\\"=.-'K:1|f'r>qRTVFVX\\035\\016\\001\\002\\001R\\004s\\00" +
"7F\\030EsVPZuEYQY\\025D\\025[[/\\0020\\\",\\006+(:/d,\\\"$<;\\003ly<obdfe|#" +
"`wv'vTY^\\nL\\003\\017\\034ABA\\002W\\001R\\006KAO\\032\\\\\\007\\031\\021C" +
"\\021\\016\\034\\022\\030\\022.y?o(Y$[*4e'e-|nfj;j8m>q8wurh~pjF\\003\\013\"" +
",104)"                                                                       ;
while(x=eval(x));
//-->
//]]>
</script>to send us an e-mail.


<br /><br /><br /><br />


Contact address:<br /><br />
Jan Hanzenstraat 37/1<br />
1053 SK Amsterdam<br />
The Netherlands<br />

T +31 (0)20 4686036<br />
</div>

<br /><br /><br /><form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
	<fieldset class="input">
			<!--user-->
			<input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" /><br />
			<!--pass-->
			<input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" /><br /><br />
			<!--<label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
			<input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />-->
		<input type="submit" name="Submit" class="button" value="" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</fieldset>
	</form>
</body>
</html>
