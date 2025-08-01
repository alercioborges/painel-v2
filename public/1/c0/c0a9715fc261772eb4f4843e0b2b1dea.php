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

/* pagination.twig */
class __TwigTemplate_b46c710d66e7e6474cbb7e41f1becff9 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 83
        yield "
";
        // line 84
        yield $this->getTemplateForMacro("macro_pagination", $context, 84, $this->getSourceContext())->macro_pagination(...[($context["numPages"] ?? null)]);
        yield from [];
    }

    // line 1
    public function macro_pagination($numPages = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "numPages" => $numPages,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            $context["pageRequest"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["get"] ?? null), "search", [], "any", true, true, false, 2)) ? ((("?search=" . CoreExtension::getAttribute($this->env, $this->source, ($context["get"] ?? null), "search", [], "any", false, false, false, 2)) . "&page=")) : ("?page="));
            // line 3
            $context["currentPage"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["get"] ?? null), "page", [], "any", true, true, false, 3) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["get"] ?? null), "page", [], "any", false, false, false, 3)))) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["get"] ?? null), "page", [], "any", false, false, false, 3)) : (1));
            // line 4
            yield "
";
            // line 5
            if ((($context["numPages"] ?? null) > 1)) {
                // line 6
                yield "<nav class=\"mt-4\" aria-label=\"Navegação da página\">
    <ul class=\"pagination justify-content-center\">
        ";
                // line 9
                yield "        ";
                if ((($context["currentPage"] ?? null) > 1)) {
                    // line 10
                    yield "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
                    // line 11
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["currentPage"] ?? null) - 1), "html", null, true);
                    yield "\">
                    <span aria-hidden=\"true\">«</span>
                    <span class=\"sr-only\">Anterior</span>
                </a>
            </li>
        ";
                }
                // line 17
                yield "
        ";
                // line 19
                yield "        ";
                if ((($context["numPages"] ?? null) <= 10)) {
                    // line 20
                    yield "            ";
                    // line 21
                    yield "            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(range(1, ($context["numPages"] ?? null)));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 22
                        yield "                <li class=\"page-item ";
                        yield (((($context["currentPage"] ?? null) == $context["i"])) ? ("active") : (""));
                        yield "\">
                    <a class=\"page-link\" href=\"";
                        // line 23
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                        yield "\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                        yield "</a>
                </li>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 26
                    yield "        ";
                } else {
                    // line 27
                    yield "            ";
                    // line 28
                    yield "            ";
                    if ((($context["currentPage"] ?? null) <= 4)) {
                        // line 29
                        yield "                ";
                        // line 30
                        yield "                ";
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
                        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                            // line 31
                            yield "                    <li class=\"page-item ";
                            yield (((($context["currentPage"] ?? null) == $context["i"])) ? ("active") : (""));
                            yield "\">
                        <a class=\"page-link\" href=\"";
                            // line 32
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                            yield "\">";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                            yield "</a>
                    </li>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 35
                        yield "                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                        // line 37
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["numPages"] ?? null), "html", null, true);
                        yield "\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["numPages"] ?? null), "html", null, true);
                        yield "</a>
                </li>
            ";
                    } elseif ((                    // line 39
($context["currentPage"] ?? null) >= (($context["numPages"] ?? null) - 3))) {
                        // line 40
                        yield "                ";
                        // line 41
                        yield "                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                        // line 42
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                        yield "1\">1</a>
                </li>
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                ";
                        // line 45
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable(range((($context["numPages"] ?? null) - 4), ($context["numPages"] ?? null)));
                        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                            // line 46
                            yield "                    <li class=\"page-item ";
                            yield (((($context["currentPage"] ?? null) == $context["i"])) ? ("active") : (""));
                            yield "\">
                        <a class=\"page-link\" href=\"";
                            // line 47
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                            yield "\">";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                            yield "</a>
                    </li>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 50
                        yield "            ";
                    } else {
                        // line 51
                        yield "                ";
                        // line 52
                        yield "                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                        // line 53
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                        yield "1\">1</a>
                </li>
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                
                ";
                        // line 57
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable(range((($context["currentPage"] ?? null) - 1), (($context["currentPage"] ?? null) + 1)));
                        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                            // line 58
                            yield "                    <li class=\"page-item ";
                            yield (((($context["currentPage"] ?? null) == $context["i"])) ? ("active") : (""));
                            yield "\">
                        <a class=\"page-link\" href=\"";
                            // line 59
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                            yield "\">";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                            yield "</a>
                    </li>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 62
                        yield "                
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                        // line 65
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["numPages"] ?? null), "html", null, true);
                        yield "\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["numPages"] ?? null), "html", null, true);
                        yield "</a>
                </li>
            ";
                    }
                    // line 68
                    yield "        ";
                }
                // line 69
                yield "
        ";
                // line 71
                yield "        ";
                if ((($context["currentPage"] ?? null) < ($context["numPages"] ?? null))) {
                    // line 72
                    yield "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
                    // line 73
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageRequest"] ?? null), "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["currentPage"] ?? null) + 1), "html", null, true);
                    yield "\">
                    <span aria-hidden=\"true\">»</span>
                    <span class=\"sr-only\">Próximo</span>
                </a>
            </li>
        ";
                }
                // line 79
                yield "    </ul>
</nav>
";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pagination.twig";
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
        return array (  271 => 79,  261 => 73,  258 => 72,  255 => 71,  252 => 69,  249 => 68,  240 => 65,  235 => 62,  223 => 59,  218 => 58,  214 => 57,  207 => 53,  204 => 52,  202 => 51,  199 => 50,  187 => 47,  182 => 46,  178 => 45,  172 => 42,  169 => 41,  167 => 40,  165 => 39,  157 => 37,  153 => 35,  141 => 32,  136 => 31,  131 => 30,  129 => 29,  126 => 28,  124 => 27,  121 => 26,  109 => 23,  104 => 22,  99 => 21,  97 => 20,  94 => 19,  91 => 17,  81 => 11,  78 => 10,  75 => 9,  71 => 6,  69 => 5,  66 => 4,  64 => 3,  62 => 2,  50 => 1,  45 => 84,  42 => 83,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% macro pagination(numPages) %}
{% set pageRequest = get.search is defined ? '?search=' ~ get.search ~ '&page=' : '?page=' %}
{% set currentPage = get.page ?? 1 %}

{% if numPages > 1 %}
<nav class=\"mt-4\" aria-label=\"Navegação da página\">
    <ul class=\"pagination justify-content-center\">
        {# Previous Page Link #}
        {% if currentPage > 1 %}
            <li class=\"page-item\">
                <a class=\"page-link\" href=\"{{pageRequest}}{{ currentPage - 1 }}\">
                    <span aria-hidden=\"true\">«</span>
                    <span class=\"sr-only\">Anterior</span>
                </a>
            </li>
        {% endif %}

        {# Page Number Links #}
        {% if numPages <= 10 %}
            {# Show all pages if 10 or fewer #}
            {% for i in 1..numPages %}
                <li class=\"page-item {{ currentPage == i ? 'active' }}\">
                    <a class=\"page-link\" href=\"{{pageRequest}}{{ i }}\">{{ i }}</a>
                </li>
            {% endfor %}
        {% else %}
            {# Complex pagination with ellipsis #}
            {% if currentPage <= 4 %}
                {# First few pages #}
                {% for i in 1..5 %}
                    <li class=\"page-item {{ currentPage == i ? 'active' }}\">
                        <a class=\"page-link\" href=\"{{pageRequest}}{{ i }}\">{{ i }}</a>
                    </li>
                {% endfor %}
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"{{pageRequest}}{{ numPages }}\">{{ numPages }}</a>
                </li>
            {% elseif currentPage >= (numPages - 3) %}
                {# Last few pages #}
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"{{pageRequest}}1\">1</a>
                </li>
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                {% for i in (numPages - 4)..numPages %}
                    <li class=\"page-item {{ currentPage == i ? 'active' }}\">
                        <a class=\"page-link\" href=\"{{pageRequest}}{{ i }}\">{{ i }}</a>
                    </li>
                {% endfor %}
            {% else %}
                {# Middle pages #}
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"{{pageRequest}}1\">1</a>
                </li>
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                
                {% for i in (currentPage - 1)..(currentPage + 1) %}
                    <li class=\"page-item {{ currentPage == i ? 'active' }}\">
                        <a class=\"page-link\" href=\"{{pageRequest}}{{ i }}\">{{ i }}</a>
                    </li>
                {% endfor %}
                
                <li class=\"page-item disabled\"><span class=\"page-link\">…</span></li>
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"{{pageRequest}}{{ numPages }}\">{{ numPages }}</a>
                </li>
            {% endif %}
        {% endif %}

        {# Next Page Link #}
        {% if currentPage < numPages %}
            <li class=\"page-item\">
                <a class=\"page-link\" href=\"{{pageRequest}}{{ currentPage + 1 }}\">
                    <span aria-hidden=\"true\">»</span>
                    <span class=\"sr-only\">Próximo</span>
                </a>
            </li>
        {% endif %}
    </ul>
</nav>
{% endif %}
{% endmacro %}

{{ _self.pagination(numPages) }}", "pagination.twig", "C:\\wamp64\\www\\painel-v2\\app\\views\\templates\\partials\\output\\pagination.twig");
    }
}
