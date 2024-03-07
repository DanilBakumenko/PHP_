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

/* main.twig */
class __TwigTemplate_62f4d72ab8dfd1ce3d2b1b212323dee0 extends Template
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
        echo "<!DOCTYPE html>
<html>
<head>
    <title>";
        // line 4
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
    <link rel=\"stylesheet\" href=\"../../styles/style.css?<?=rand(1,100000000)?>\">
</head>
<body>
<div class=\"content\">
    <div class=\"body\">
        <div class=\"header\">
            <nav class=\"menu\">
                <a class=\"link\" href=\"/\">Главная</a>
                <a class=\"link\" href=\"/info\">Информация о сайте</a>
                <a class=\"link\" href=\"/about\">О нас</a>
                <a class=\"link\" href=\"/user\">Пользователи</a>
            </nav>
        </div>
        <div class=\"main\">
            ";
        // line 19
        $this->loadTemplate(($context["content_template_name"] ?? null), "main.twig", 19)->display($context);
        // line 20
        echo "        </div>
        <footer class=\"footer\">
            <p>© 2024 Все права защищены.</p>
        </footer>
    </div>
    <div class=\"side_bar\">

    </div>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 20,  60 => 19,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "main.twig", "/data/mysite.local/src/Views/main.twig");
    }
}
