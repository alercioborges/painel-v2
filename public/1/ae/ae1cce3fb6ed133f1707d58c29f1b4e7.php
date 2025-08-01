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

/* pages/users.html */
class __TwigTemplate_206fa2c99ae1337df8f6ee5cd92a8cf7 extends Template
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
        yield "\t\t\t\t
\t<div class=\"card-tools\">\t\t
\t\t<form action=\"#\" method=\"GET\">\t\t\t
\t\t\t<div class=\"input-group input-group-sm\" style=\"width: 150px;\">\t\t\t
\t\t\t\t<input type=\"text\" name=\"search\" class=\"form-control float-right\" placeholder=\"Search\">\t
\t\t\t\t<div class=\"input-group-append\">
\t\t\t\t\t<button type=\"submit\" class=\"btn btn-default\">
\t\t\t\t\t\t<i class=\"fas fa-search\"></i>
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</form>

\t</div>
</div><!-- /.card-header -->\t\t\t
<div class=\"card-body table-responsive p-0\">

\t";
        // line 20
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["USERS"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "
\t\t";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("message"), "html", null, true);
            yield "
\t\t<table id=\"users-list\" class=\"table table-hover text-nowrap\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Nome</th>
\t\t\t\t\t<th>E-mail</th>
\t\t\t\t\t<th>Perfil</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t\t";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["USERS"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
                // line 34
                yield "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "id", [], "any", false, false, false, 35), "html", null, true);
                yield "</td>
\t\t\t\t\t\t<td><a href=\"";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
                yield "/admin/users/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "id", [], "any", false, false, false, 36), "html", null, true);
                yield "/profile\" class=\"link-secondary\" >";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "firstname", [], "any", false, false, false, 36), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "lastname", [], "any", false, false, false, 36), "html", null, true);
                yield "</a></td>
\t\t\t\t\t\t<td>";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "email", [], "any", false, false, false, 37), "html", null, true);
                yield "</td>
\t\t\t\t\t\t<td>";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "role", [], "any", false, false, false, 38), "html", null, true);
                yield "</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
                yield "/admin/users/edit/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "id", [], "any", false, false, false, 40), "html", null, true);
                yield "\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-edit\"></i> Editar</a>

\t\t\t\t\t\t\t<!-- Início Modal de exclusão de usuário -->
\t\t\t\t\t\t\t<!-- Início link excluir Modal -->
\t\t\t\t\t\t\t<a href=\"#\" data-toggle=\"modal\" data-target=\"#confirm-delete-";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "id", [], "any", false, false, false, 44), "html", null, true);
                yield "\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Excluir</a>
\t\t\t\t\t\t\t<!-- Fim link excluir Modal -->
\t\t\t\t\t\t\t<!-- Início da janela do Modal -->
\t\t\t\t\t\t\t<div class=\"modal fade\" id=\"confirm-delete-";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "id", [], "any", false, false, false, 47), "html", null, true);
                yield "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
\t\t\t\t\t\t\t\t<div class=\"modal-dialog modal-dialog-centered modal-lg\" role=\"document\">
\t\t\t\t\t\t\t\t\t<div class=\"modal-content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t\t\t\t\t\t\t<h3><b>Exclusão de usuário</b></h3>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t\t\t\t\t\t<p><h6>Deseja realmente excluir o usuário de nome ";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "firstname", [], "any", false, false, false, 54), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "lastname", [], "any", false, false, false, 54), "html", null, true);
                yield " <br>e de e-mail ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "email", [], "any", false, false, false, 54), "html", null, true);
                yield "?</h6></p>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-success\" data-dismiss=\"modal\">Cancelar</button>
\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 58
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
                yield "/admin/users/delete/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "id", [], "any", false, false, false, 58), "html", null, true);
                yield "\" class=\"btn btn-danger btn-ok\">Deletar</a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- Fim da da janela do Modal -->
\t\t\t\t\t\t<!-- Fim do modal de exclusão de usuário -->

\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['data'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            yield "\t\t</tbody>
\t";
        } else {
            // line 72
            yield "\t\t<div class=\"alert alert-danger mt-1\" role=\"alert\">
\t\t\t<strong>Não há usuários cadastrados</strong>
\t\t</div>
\t";
        }
        // line 76
        yield "</table>
</div><!-- /. card-body table-responsive -->

";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('pagination')->getCallable()(($context["PAGES"] ?? null)), "html", null, true);
        yield "

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/users.html";
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
        return array (  196 => 79,  191 => 76,  185 => 72,  181 => 70,  161 => 58,  150 => 54,  140 => 47,  134 => 44,  125 => 40,  120 => 38,  116 => 37,  106 => 36,  102 => 35,  99 => 34,  95 => 33,  81 => 22,  78 => 21,  76 => 20,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'pages/base.twig' %}

{% block content %}\t\t\t\t
\t<div class=\"card-tools\">\t\t
\t\t<form action=\"#\" method=\"GET\">\t\t\t
\t\t\t<div class=\"input-group input-group-sm\" style=\"width: 150px;\">\t\t\t
\t\t\t\t<input type=\"text\" name=\"search\" class=\"form-control float-right\" placeholder=\"Search\">\t
\t\t\t\t<div class=\"input-group-append\">
\t\t\t\t\t<button type=\"submit\" class=\"btn btn-default\">
\t\t\t\t\t\t<i class=\"fas fa-search\"></i>
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</form>

\t</div>
</div><!-- /.card-header -->\t\t\t
<div class=\"card-body table-responsive p-0\">

\t{% if USERS is not empty %}

\t\t{{ message('message') }}
\t\t<table id=\"users-list\" class=\"table table-hover text-nowrap\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Nome</th>
\t\t\t\t\t<th>E-mail</th>
\t\t\t\t\t<th>Perfil</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t\t{% for data in USERS %}
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>{{ data.id }}</td>
\t\t\t\t\t\t<td><a href=\"{{ get_full_url() }}/admin/users/{{data.id}}/profile\" class=\"link-secondary\" >{{ data.firstname }} {{ data.lastname }}</a></td>
\t\t\t\t\t\t<td>{{ data.email }}</td>
\t\t\t\t\t\t<td>{{ data.role }}</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<a href=\"{{ get_full_url() }}/admin/users/edit/{{data.id}}\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-edit\"></i> Editar</a>

\t\t\t\t\t\t\t<!-- Início Modal de exclusão de usuário -->
\t\t\t\t\t\t\t<!-- Início link excluir Modal -->
\t\t\t\t\t\t\t<a href=\"#\" data-toggle=\"modal\" data-target=\"#confirm-delete-{{data.id}}\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Excluir</a>
\t\t\t\t\t\t\t<!-- Fim link excluir Modal -->
\t\t\t\t\t\t\t<!-- Início da janela do Modal -->
\t\t\t\t\t\t\t<div class=\"modal fade\" id=\"confirm-delete-{{data.id}}\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
\t\t\t\t\t\t\t\t<div class=\"modal-dialog modal-dialog-centered modal-lg\" role=\"document\">
\t\t\t\t\t\t\t\t\t<div class=\"modal-content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t\t\t\t\t\t\t<h3><b>Exclusão de usuário</b></h3>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t\t\t\t\t\t<p><h6>Deseja realmente excluir o usuário de nome {{data.firstname}} {{data.lastname}} <br>e de e-mail {{data.email}}?</h6></p>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-success\" data-dismiss=\"modal\">Cancelar</button>
\t\t\t\t\t\t\t\t\t\t\t<a href=\"{{ get_full_url() }}/admin/users/delete/{{data.id}}\" class=\"btn btn-danger btn-ok\">Deletar</a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- Fim da da janela do Modal -->
\t\t\t\t\t\t<!-- Fim do modal de exclusão de usuário -->

\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t{% endfor %}
\t\t</tbody>
\t{% else %}
\t\t<div class=\"alert alert-danger mt-1\" role=\"alert\">
\t\t\t<strong>Não há usuários cadastrados</strong>
\t\t</div>
\t{% endif %}
</table>
</div><!-- /. card-body table-responsive -->

{{ pagination(PAGES) }}

{% endblock %}", "pages/users.html", "C:\\wamp64\\www\\painel-v2\\app\\views\\templates\\pages\\users.html");
    }
}
