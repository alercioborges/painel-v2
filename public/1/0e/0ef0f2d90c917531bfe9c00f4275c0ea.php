<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* pages/base.twig */
class __TwigTemplate_2a11c710693b4c446a7967a983582add extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "
";
        // line 2
        yield from $this->load("partials/header.twig", 2)->unwrap()->yield($context);
        // line 3
        yield "
";
        // line 4
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 5
        yield "
";
        // line 6
        yield from $this->load("partials/footer.twig", 6)->unwrap()->yield($context);
        // line 7
        yield "

";
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/base.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  65 => 4,  58 => 7,  56 => 6,  53 => 5,  51 => 4,  48 => 3,  46 => 2,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("
{% include 'partials/header.twig' %}

{% block content %}{% endblock %}

{% include 'partials/footer.twig' %}


", "pages/base.twig", "C:\\wamp64\\www\\painel-v2\\app\\views\\templates\\pages\\base.twig");
    }
}
