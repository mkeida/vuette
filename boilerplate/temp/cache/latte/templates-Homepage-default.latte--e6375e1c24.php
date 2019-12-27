<?php
// source: /Applications/MAMP/htdocs/sandbox/app/presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Templatee6375e1c24 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <my-component></my-component>

    <p>Hello world from Nette template!</p>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Books:test", ['id' => 2, 'user' => 5])) ?>">Odkaz z Nette template</a>
    <router-link to='/foo'>Odkaz!</router-link>

    <router-view></router-view>

<?php
	}

}
