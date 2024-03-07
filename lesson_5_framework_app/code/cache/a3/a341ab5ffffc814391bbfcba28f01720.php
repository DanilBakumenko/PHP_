<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* info.twig */
class __TwigTemplate_d0a46625e58028f27f6fb3fd76291c45 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo twig_escape_filter($this->env, ($context["serverInfo"] ?? null), "html", null, true);
        echo "<br>
";
        // line 2
        echo twig_escape_filter($this->env, ($context["phpVersion"] ?? null), "html", null, true);
        echo "<br>
";
        // line 3
        echo twig_escape_filter($this->env, ($context["userAgent"] ?? null), "html", null, true);
    }

    public function getTemplateName()
    {
        return "info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "info.twig", "/data/mysite.local/src/Views/info.twig");
    }
}
