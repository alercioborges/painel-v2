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

/* pages/user-update.html */
class __TwigTemplate_f171d03bbf8430e9c96e83c0d7972e1c extends Template
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

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "pages/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("pages/base.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<div class=\"card-tools\"></div>
</div><!-- /.card-header -->
<div class=\"card-body p-0\">


\t<form class=\"form-horizontal\" method=\"POST\" action=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/admin/users/edit/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = ($context["USER"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["id"] ?? null) : null), "html", null, true);
        yield "\">
\t\t<div class=\"card-body\">\t\t\t\t\t

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"firstname-input-form\" class=\"col-sm-2 col-form-label\">Nome</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"text\" onkeydown=\"return /^[a-záàâãéèêíïóôõöúçñ ]+\$/i.test(event.key)\" class=\"form-control\" name=\"firstname\" id=\"firstname-input-form\" placeholder=\"Nome\" ";
        // line 15
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["COOKIE_DATA"] ?? null), "firstname", [], "array", true, true, false, 15)) {
            yield " value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v1 = ($context["COOKIE_DATA"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["firstname"] ?? null) : null), "html", null, true);
            yield "\" ";
        } else {
            yield " value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v2 = ($context["USER"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2["firstname"] ?? null) : null), "html", null, true);
            yield "\" ";
        }
        yield " >
\t\t\t\t\t";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("firstname"), "html", null, true);
        yield "
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"lastname-input-form\" class=\"col-sm-2 col-form-label\">Sobrenome</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"text\" onkeydown=\"return /^[a-záàâãéèêíïóôõöúçñ ]+\$/i.test(event.key)\" class=\"form-control\" name=\"lastname\" id=\"lastname-input-form\" placeholder=\"Sobrenome\" ";
        // line 23
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["COOKIE_DATA"] ?? null), "lastname", [], "array", true, true, false, 23)) {
            yield " value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v3 = ($context["COOKIE_DATA"] ?? null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3["lastname"] ?? null) : null), "html", null, true);
            yield "\" ";
        } else {
            yield " value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v4 = ($context["USER"] ?? null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4["lastname"] ?? null) : null), "html", null, true);
            yield "\" ";
        }
        yield ">
\t\t\t\t\t";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("lastname"), "html", null, true);
        yield "
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"email-input-form\" class=\"col-sm-2 col-form-label\">E-mail</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"email\" class=\"form-control\" name=\"email\" id=\"email-input-form\" placeholder=\"E-mail\" ";
        // line 31
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["COOKIE_DATA"] ?? null), "email", [], "array", true, true, false, 31)) {
            yield " value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v5 = ($context["COOKIE_DATA"] ?? null)) && is_array($_v5) || $_v5 instanceof ArrayAccess ? ($_v5["email"] ?? null) : null), "html", null, true);
            yield "\" ";
        } else {
            yield " value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v6 = ($context["USER"] ?? null)) && is_array($_v6) || $_v6 instanceof ArrayAccess ? ($_v6["email"] ?? null) : null), "html", null, true);
            yield "\" ";
        }
        yield " >
\t\t\t\t\t";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("email"), "html", null, true);
        yield "
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"role-input-form\" class=\"col-sm-2 col-form-label\">Tipo de perfil</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t
\t\t\t\t\t<select class=\"form-select form-control\" name=\"role_id\" id=\"role-input-form\">\t\t\t\t\t
\t\t\t\t\t\t<option value=\"\">Selecione</option>\t\t\t\t\t\t
\t\t\t\t\t\t\t";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["ROLES"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 43
            yield "\t\t\t\t\t\t\t\t";
            if (Twig\Extension\CoreExtension::testEmpty((($_v7 = ($context["COOKIE_DATA"] ?? null)) && is_array($_v7) || $_v7 instanceof ArrayAccess ? ($_v7["role_id"] ?? null) : null))) {
                // line 44
                yield "\t\t\t\t\t\t\t\t\t";
                if (((($_v8 = $context["role"]) && is_array($_v8) || $_v8 instanceof ArrayAccess ? ($_v8["id"] ?? null) : null) == (($_v9 = ($context["USER"] ?? null)) && is_array($_v9) || $_v9 instanceof ArrayAccess ? ($_v9["role_id"] ?? null) : null))) {
                    // line 45
                    yield "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v10 = $context["role"]) && is_array($_v10) || $_v10 instanceof ArrayAccess ? ($_v10["id"] ?? null) : null), "html", null, true);
                    yield "\" selected >";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v11 = $context["role"]) && is_array($_v11) || $_v11 instanceof ArrayAccess ? ($_v11["name"] ?? null) : null), "html", null, true);
                    yield "</option>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 47
                    yield "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v12 = $context["role"]) && is_array($_v12) || $_v12 instanceof ArrayAccess ? ($_v12["id"] ?? null) : null), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v13 = $context["role"]) && is_array($_v13) || $_v13 instanceof ArrayAccess ? ($_v13["name"] ?? null) : null), "html", null, true);
                    yield "</option>
\t\t\t\t\t\t\t\t\t";
                }
                // line 49
                yield "\t\t\t\t\t\t\t\t";
            } elseif (((($_v14 = ($context["COOKIE_DATA"] ?? null)) && is_array($_v14) || $_v14 instanceof ArrayAccess ? ($_v14["role_id"] ?? null) : null) == (($_v15 = $context["role"]) && is_array($_v15) || $_v15 instanceof ArrayAccess ? ($_v15["id"] ?? null) : null))) {
                // line 50
                yield "\t\t\t\t\t\t\t\t\t<option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v16 = $context["role"]) && is_array($_v16) || $_v16 instanceof ArrayAccess ? ($_v16["id"] ?? null) : null), "html", null, true);
                yield "\" selected >";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v17 = $context["role"]) && is_array($_v17) || $_v17 instanceof ArrayAccess ? ($_v17["name"] ?? null) : null), "html", null, true);
                yield "</optio>
\t\t\t\t\t\t\t\t";
            } else {
                // line 52
                yield "\t\t\t\t\t\t\t\t\t<option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v18 = $context["role"]) && is_array($_v18) || $_v18 instanceof ArrayAccess ? ($_v18["id"] ?? null) : null), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v19 = $context["role"]) && is_array($_v19) || $_v19 instanceof ArrayAccess ? ($_v19["name"] ?? null) : null), "html", null, true);
                yield "</option>
\t\t\t\t\t\t\t\t";
            }
            // line 54
            yield "\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['role'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        yield "\t\t\t\t\t\t</select>
\t\t\t\t\t";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("role"), "html", null, true);
        yield "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"form-group row\">
\t\t\t\t<div class=\"offset-sm-2 col-sm-10\">\t\t\t\t\t
\t\t\t\t</div>
\t\t\t</div>
\t\t</div><!-- /.card-body -->
\t\t<div class=\"card-footer\">
\t\t\t<button type=\"submit\" class=\"btn btn-info\">Cadastrar</button>
\t\t</div><!-- /.card-footer -->
\t</form>
</div><!-- /.card-body -->
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/user-update.html";
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
        return array (  199 => 56,  196 => 55,  190 => 54,  182 => 52,  174 => 50,  171 => 49,  163 => 47,  155 => 45,  152 => 44,  149 => 43,  145 => 42,  132 => 32,  120 => 31,  110 => 24,  98 => 23,  88 => 16,  76 => 15,  65 => 9,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'pages/base.twig' %}

{% block content %}
<div class=\"card-tools\"></div>
</div><!-- /.card-header -->
<div class=\"card-body p-0\">


\t<form class=\"form-horizontal\" method=\"POST\" action=\"{{ get_full_url() }}/admin/users/edit/{{ USER['id'] }}\">
\t\t<div class=\"card-body\">\t\t\t\t\t

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"firstname-input-form\" class=\"col-sm-2 col-form-label\">Nome</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"text\" onkeydown=\"return /^[a-záàâãéèêíïóôõöúçñ ]+\$/i.test(event.key)\" class=\"form-control\" name=\"firstname\" id=\"firstname-input-form\" placeholder=\"Nome\" {% if COOKIE_DATA['firstname'] is defined %} value=\"{{ COOKIE_DATA['firstname'] }}\" {% else %} value=\"{{ USER['firstname'] }}\" {% endif %} >
\t\t\t\t\t{{ message(\"firstname\") }}
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"lastname-input-form\" class=\"col-sm-2 col-form-label\">Sobrenome</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"text\" onkeydown=\"return /^[a-záàâãéèêíïóôõöúçñ ]+\$/i.test(event.key)\" class=\"form-control\" name=\"lastname\" id=\"lastname-input-form\" placeholder=\"Sobrenome\" {% if COOKIE_DATA['lastname'] is defined %} value=\"{{ COOKIE_DATA['lastname'] }}\" {% else %} value=\"{{ USER['lastname'] }}\" {% endif %}>
\t\t\t\t\t{{ message(\"lastname\") }}
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"email-input-form\" class=\"col-sm-2 col-form-label\">E-mail</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"email\" class=\"form-control\" name=\"email\" id=\"email-input-form\" placeholder=\"E-mail\" {% if COOKIE_DATA['email'] is defined %} value=\"{{ COOKIE_DATA['email'] }}\" {% else %} value=\"{{ USER['email'] }}\" {% endif %} >
\t\t\t\t\t{{ message(\"email\") }}
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"form-group row\">
\t\t\t\t<label for=\"role-input-form\" class=\"col-sm-2 col-form-label\">Tipo de perfil</label>
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t
\t\t\t\t\t<select class=\"form-select form-control\" name=\"role_id\" id=\"role-input-form\">\t\t\t\t\t
\t\t\t\t\t\t<option value=\"\">Selecione</option>\t\t\t\t\t\t
\t\t\t\t\t\t\t{% for role in ROLES %}
\t\t\t\t\t\t\t\t{% if COOKIE_DATA['role_id'] is empty %}
\t\t\t\t\t\t\t\t\t{% if role['id'] == USER['role_id'] %}
\t\t\t\t\t\t\t\t\t\t<option value=\"{{ role['id'] }}\" selected >{{ role['name'] }}</option>
\t\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t\t<option value=\"{{ role['id'] }}\">{{ role['name'] }}</option>
\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t{% elseif COOKIE_DATA['role_id'] == role['id'] %}
\t\t\t\t\t\t\t\t\t<option value=\"{{ role['id'] }}\" selected >{{ role['name'] }}</optio>
\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t<option value=\"{{ role['id'] }}\">{{ role['name'] }}</option>
\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</select>
\t\t\t\t\t{{ message(\"role\") }}
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"form-group row\">
\t\t\t\t<div class=\"offset-sm-2 col-sm-10\">\t\t\t\t\t
\t\t\t\t</div>
\t\t\t</div>
\t\t</div><!-- /.card-body -->
\t\t<div class=\"card-footer\">
\t\t\t<button type=\"submit\" class=\"btn btn-info\">Cadastrar</button>
\t\t</div><!-- /.card-footer -->
\t</form>
</div><!-- /.card-body -->
{% endblock %}", "pages/user-update.html", "C:\\wamp64\\www\\painel-v2\\app\\views\\templates\\pages\\user-update.html");
    }
}
