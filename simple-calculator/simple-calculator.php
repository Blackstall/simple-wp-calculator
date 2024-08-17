<?php
/*
Plugin Name: Simple Calculator
Description: A simple calculator plugin for WordPress.
Version: 1.0
Author: Murni Jaya first project
*/

// Enqueue the plugin's stylesheet
function simple_calculator_enqueue_styles() {
    wp_enqueue_style('simple-calculator-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'simple_calculator_enqueue_styles');

// Add shortcode for the calculator
function simple_calculator_shortcode() {
    ob_start();
    ?>
    <div id="calculator">
        <form id="calc-form">
            <input type="text" id="display" readonly />
            <div>
                <button type="button" class="calc-button" data-value="7">7</button>
                <button type="button" class="calc-button" data-value="8">8</button>
                <button type="button" class="calc-button" data-value="9">9</button>
                <button type="button" class="calc-button" data-value="/">/</button>
            </div>
            <div>
                <button type="button" class="calc-button" data-value="4">4</button>
                <button type="button" class="calc-button" data-value="5">5</button>
                <button type="button" class="calc-button" data-value="6">6</button>
                <button type="button" class="calc-button" data-value="*">*</button>
            </div>
            <div>
                <button type="button" class="calc-button" data-value="1">1</button>
                <button type="button" class="calc-button" data-value="2">2</button>
                <button type="button" class="calc-button" data-value="3">3</button>
                <button type="button" class="calc-button" data-value="-">-</button>
            </div>
            <div>
                <button type="button" class="calc-button" data-value="0">0</button>
                <button type="button" class="calc-button" data-value=".">.</button>
                <button type="button" id="calc-equal">=</button>
                <button type="button" class="calc-button" data-value="+">+</button>
            </div>
            <div>
                <button type="button" id="calc-clear">C</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const display = document.getElementById('display');
            const buttons = document.querySelectorAll('.calc-button');
            const equalButton = document.getElementById('calc-equal');
            const clearButton = document.getElementById('calc-clear');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    display.value += this.dataset.value;
                });
            });

            equalButton.addEventListener('click', function () {
                try {
                    display.value = eval(display.value);
                } catch (e) {
                    display.value = 'Error';
                }
            });

            clearButton.addEventListener('click', function () {
                display.value = '';
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('simple_calculator', 'simple_calculator_shortcode');
