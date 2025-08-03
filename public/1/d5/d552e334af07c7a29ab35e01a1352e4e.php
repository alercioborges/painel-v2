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

/* pages/login.html */
class __TwigTemplate_2eef8b684d9a49a4d77ade3a38eccdcb extends Template
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
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"pt-br\">
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["TITLE"] ?? null), "html", null, true);
        yield "</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback\">
  <!-- Font Awesome -->
  <link rel=\"stylesheet\" href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/plugins/fontawesome-free/css/all.min.css\">
  <!-- icheck bootstrap -->
  <link rel=\"stylesheet\" href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css\">
  <!-- Theme style -->
  <link rel=\"stylesheet\" href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/dist/css/adminlte.min.css\">
</head>
<body class=\"hold-transition login-page bg-primary\">
  <div class=\"login-box\">
    <!-- /.login-logo -->
    <div class=\"card card-outline card-primary\">
      <div class=\"card-header text-center\">
        <b class=\"h1\" style=\"color: black;\">Dashboard</b>
      </div>
      <div class=\"card-body\">
        <form action=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/login\" method=\"POST\">
          <div class=\"input-group mb-3\">
            ";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("error"), "html", null, true);
        yield "
            <input type=\"email\" class=\"form-control border border-dark\" name=\"email\" placeholder=\"Email\" value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["COOKIE_EMAIL"] ?? null), "html", null, true);
        yield "\" maxlength=\"30\" autofocus required>
            <div class=\"input-group-append\">
              <div class=\"input-group-text\">
                <span class=\"fas fa-envelope\"></span>                
              </div>              
            </div>                                  
          </div>
          ";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('message')->getCallable()("email"), "html", null, true);
        yield "  


          <div class=\"input-group mb-3\">
            <input type=\"password\" class=\"form-control border border-dark\" name=\"password\" placeholder=\"Password\" maxlength=\"30\" required>            
            <div class=\"input-group-append\">
              <div class=\"input-group-text\">
                <span class=\"fas fa-lock\"></span>
              </div>
            </div>
          </div>

          <div class=\"row\">
            <div class=\"col-8\">
              <div class=\"icheck-primary\">
                <input type=\"checkbox\" id=\"remember\">
                <label style=\"color: grey;\" for=\"remember\">
                  Lembre-me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class=\"col-4\">
              <button type=\"submit\" class=\"btn btn-primary btn-block\">Acessar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>      

        <div class=\"row\">
          <div class=\"col-6\"></div>
          <div class=\"col-6\">           
            <p class=\"mb-1\">
              <a href=\"";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/forgot-password.html\">Perdeu a senha?</a>
            </p>
          </div>
        </div>
        <div class=\"row\">      
          <div class=\"col-6\"></div>
          <div class=\"col-6\"> 
            <p class=\"mb-0\">
              <a href=\"";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/register.html\" class=\"text-center\">Cadastre-se</a>
            </p>
          </div>
        </div>";
        // line 79
        yield Twig\Extension\DebugExtension::dump($this->env, $context, ...[($context["session"] ?? null)]);
        yield "
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>  
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src=\"";
        // line 88
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/plugins/jquery/jquery.min.js\"></script>
  <!-- Bootstrap 4 -->
  <script src=\"";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js\"></script>
  <!-- AdminLTE App -->
  <script src=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/dist/js/adminlte.min.js\"></script>
</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/login.html";
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
        return array (  174 => 92,  169 => 90,  164 => 88,  152 => 79,  146 => 76,  135 => 68,  99 => 35,  89 => 28,  85 => 27,  80 => 25,  67 => 15,  62 => 13,  57 => 11,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"pt-br\">
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>{{ TITLE }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback\">
  <!-- Font Awesome -->
  <link rel=\"stylesheet\" href=\"{{ get_full_url() }}/assets/resource/adminlte/plugins/fontawesome-free/css/all.min.css\">
  <!-- icheck bootstrap -->
  <link rel=\"stylesheet\" href=\"{{ get_full_url() }}/assets/resource/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css\">
  <!-- Theme style -->
  <link rel=\"stylesheet\" href=\"{{ get_full_url() }}/assets/resource/adminlte/dist/css/adminlte.min.css\">
</head>
<body class=\"hold-transition login-page bg-primary\">
  <div class=\"login-box\">
    <!-- /.login-logo -->
    <div class=\"card card-outline card-primary\">
      <div class=\"card-header text-center\">
        <b class=\"h1\" style=\"color: black;\">Dashboard</b>
      </div>
      <div class=\"card-body\">
        <form action=\"{{ get_full_url() }}/login\" method=\"POST\">
          <div class=\"input-group mb-3\">
            {{ message('error') }}
            <input type=\"email\" class=\"form-control border border-dark\" name=\"email\" placeholder=\"Email\" value=\"{{ COOKIE_EMAIL }}\" maxlength=\"30\" autofocus required>
            <div class=\"input-group-append\">
              <div class=\"input-group-text\">
                <span class=\"fas fa-envelope\"></span>                
              </div>              
            </div>                                  
          </div>
          {{ message(\"email\") }}  


          <div class=\"input-group mb-3\">
            <input type=\"password\" class=\"form-control border border-dark\" name=\"password\" placeholder=\"Password\" maxlength=\"30\" required>            
            <div class=\"input-group-append\">
              <div class=\"input-group-text\">
                <span class=\"fas fa-lock\"></span>
              </div>
            </div>
          </div>

          <div class=\"row\">
            <div class=\"col-8\">
              <div class=\"icheck-primary\">
                <input type=\"checkbox\" id=\"remember\">
                <label style=\"color: grey;\" for=\"remember\">
                  Lembre-me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class=\"col-4\">
              <button type=\"submit\" class=\"btn btn-primary btn-block\">Acessar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>      

        <div class=\"row\">
          <div class=\"col-6\"></div>
          <div class=\"col-6\">           
            <p class=\"mb-1\">
              <a href=\"{{ get_full_url() }}/assets/resource/adminlte/forgot-password.html\">Perdeu a senha?</a>
            </p>
          </div>
        </div>
        <div class=\"row\">      
          <div class=\"col-6\"></div>
          <div class=\"col-6\"> 
            <p class=\"mb-0\">
              <a href=\"{{ get_full_url() }}/assets/resource/adminlte/register.html\" class=\"text-center\">Cadastre-se</a>
            </p>
          </div>
        </div>{{ dump(session) }}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>  
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src=\"{{ get_full_url() }}/assets/resource/adminlte/plugins/jquery/jquery.min.js\"></script>
  <!-- Bootstrap 4 -->
  <script src=\"{{ get_full_url() }}/assets/resource/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js\"></script>
  <!-- AdminLTE App -->
  <script src=\"{{ get_full_url() }}/assets/resource/adminlte/dist/js/adminlte.min.js\"></script>
</body>
</html>
", "pages/login.html", "C:\\wamp64\\www\\painel-v2\\app\\views\\templates\\pages\\login.html");
    }
}
