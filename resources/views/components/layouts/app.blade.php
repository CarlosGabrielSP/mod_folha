<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-base-100 text-base-content min-h-screen">
    <x-layouts.navbar-primary />

    {{ $slot }}

    <footer class="footer footer-center p-4 text-accent mt-4">
        <div>
            <div>Copyright © {{ date('Y') }} - Todos os direitos reservados</div>
            <div>Desenvolvido por <a href="#"
                    class="link link-hover font-bold italic text-lg text-primary hover:text-primary-focus">Locasis</a>
            </div>
        </div>
    </footer>

    @livewireScripts

    <script>
        // Script para gerenciar a troca de temas
        document.addEventListener('DOMContentLoaded', function () {
            const themeController = document.querySelector('.theme-controller');
            const html = document.documentElement;

            // Carregar tema salvo ou usar o padrão
            const savedTheme = localStorage.getItem('theme') || 'bumblebee';
            html.setAttribute('data-theme', savedTheme);
            html.classList.toggle('dark', savedTheme === 'black');

            // Atualizar o estado do toggle
            if (themeController) {
                themeController.checked = savedTheme === 'black';

                // Adicionar listener para mudanças
                themeController.addEventListener('change', function () {
                    const newTheme = this.checked ? 'black' : 'bumblebee';
                    html.setAttribute('data-theme', newTheme);
                    html.classList.toggle('dark', this.checked);
                    localStorage.setItem('theme', newTheme);
                });
            }
        });
    </script>
</body>

</html>