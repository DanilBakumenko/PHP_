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
            'header' => [$this, 'block_header'],
            'footer' => [$this, 'block_footer'],
            'sidebar' => [$this, 'block_sidebar'],
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
    <link rel=\"stylesheet\" href=\"./styles/style.css?<?=rand(1,100000000)?>\">
</head>
<body>
<div class=\"content\">
    <div class=\"body\">
        <div class=\"header\">
            ";
        // line 11
        $this->displayBlock('header', $context, $blocks);
        // line 18
        echo "        </div>
        <div class=\"main\">
            ";
        // line 20
        $this->loadTemplate(($context["content_template_name"] ?? null), "main.twig", 20)->display($context);
        // line 21
        echo "        </div>
        <footer class=\"footer\">
            ";
        // line 23
        $this->displayBlock('footer', $context, $blocks);
        // line 26
        echo "        </footer>
    </div>
    <div class=\"side_bar\">
        ";
        // line 29
        $this->displayBlock('sidebar', $context, $blocks);
        // line 37
        echo "    </div>
</div>
</body>
</html>";
    }

    // line 11
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 12
        echo "                <div class=\"time\">
                    <p>
                        ";
        // line 14
        echo twig_escape_filter($this->env, ($context["time"] ?? null), "html", null, true);
        echo "
                    </p>
                </div>
            ";
    }

    // line 23
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 24
        echo "                <p class=\"cop\">© 2024 Все права защищены.</p>
            ";
    }

    // line 29
    public function block_sidebar($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 30
        echo "            <nav class=\"menu\">
                <a class=\"link\" href=\"/\">Главная</a>
                <a class=\"link\" href=\"/info\">Информация о сайте</a>
                <a class=\"link\" href=\"/about\">О нас</a>
                <a class=\"link\" href=\"/user\">Пользователи</a>
            </nav>
        ";
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
        return array (  112 => 30,  108 => 29,  103 => 24,  99 => 23,  91 => 14,  87 => 12,  83 => 11,  76 => 37,  74 => 29,  69 => 26,  67 => 23,  63 => 21,  61 => 20,  57 => 18,  55 => 11,  45 => 4,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "main.twig", "/data/mysite.local/src/Views/main.twig");
    }
}
