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

/* partials/footer.twig */
class __TwigTemplate_971bf1c11d73423f539d9e322670fc36 extends Template
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
        yield "              </div><!-- /.card -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->
    </div><!-- /.content-wrapper -->
    
    <!-- Main Footer -->
    <footer class=\"main-footer\">
      <!-- To the right -->
      <div class=\"float-right d-none d-sm-inline\">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href=\"https://adminlte.io\">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div><!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/plugins/jquery/jquery.min.js\"></script>
  <!-- Bootstrap 4 -->
  <script src=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js\"></script>
  <!-- AdminLTE App -->
  <script src=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('get_full_url')->getCallable()(), "html", null, true);
        yield "/assets/resource/adminlte/dist/js/adminlte.min.js\"></script>
</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/footer.twig";
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
        return array (  75 => 26,  70 => 24,  65 => 22,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("              </div><!-- /.card -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->
    </div><!-- /.content-wrapper -->
    
    <!-- Main Footer -->
    <footer class=\"main-footer\">
      <!-- To the right -->
      <div class=\"float-right d-none d-sm-inline\">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href=\"https://adminlte.io\">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div><!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src=\"{{ get_full_url() }}/assets/resource/adminlte/plugins/jquery/jquery.min.js\"></script>
  <!-- Bootstrap 4 -->
  <script src=\"{{ get_full_url() }}/assets/resource/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js\"></script>
  <!-- AdminLTE App -->
  <script src=\"{{ get_full_url() }}/assets/resource/adminlte/dist/js/adminlte.min.js\"></script>
</body>
</html>", "partials/footer.twig", "C:\\wamp64\\www\\painel-v2\\app\\views\\templates\\partials\\footer.twig");
    }
}
