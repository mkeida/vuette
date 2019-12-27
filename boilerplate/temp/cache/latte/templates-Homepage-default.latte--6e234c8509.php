<?php
// source: /Applications/MAMP/htdocs/boilerplate/app/presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template6e234c8509 extends Latte\Runtime\Template
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
?>    <my-component></my-component>

    <p>Hello world from Nette template!</p>

        <n-link to='Homepage:default' :params="{ id: 1, chapter: 7 }">Odkaz</n-link>
<?php
	}

}
