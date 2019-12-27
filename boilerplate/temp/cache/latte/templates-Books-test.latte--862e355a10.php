<?php
// source: /Applications/MAMP/htdocs/sandbox/app/presenters/templates/Books/test.latte

use Latte\Runtime as LR;

class Template862e355a10 extends Latte\Runtime\Template
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
		?>    <p>id: <?php echo LR\Filters::escapeHtmlText($id) /* line 2 */ ?></p>
    <p>user: <?php echo LR\Filters::escapeHtmlText($user) /* line 3 */ ?></p>

    <my-component></my-component>
<?php
	}

}
