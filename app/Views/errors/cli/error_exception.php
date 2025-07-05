<?php

use CodeIgniter\CLI\CLI;

// Imprime el nombre de la clase de la excepción capturada en consola, con colores (rojo sobre gris claro)
CLI::write('[' . $exception::class . ']', 'light_gray', 'red');
// Imprime el mensaje de la excepción
CLI::write($message);
// Muestra la ubicación del archivo y línea donde se lanzó la excepción (en verde)
CLI::write('at ' . CLI::color(clean_path($exception->getFile()) . ':' . $exception->getLine(), 'green'));
// Salto de línea en la consola
CLI::newLine();

// Guarda la última excepción para analizar el "encadenamiento" de errores
$last = $exception;

// Muestra si hay excepciones previas encadenadas (Exception Chaining)
while ($prevException = $last->getPrevious()) {
    $last = $prevException;

    CLI::write('  Caused by:'); // Etiqueta
    CLI::write('  [' . $prevException::class . ']', 'red'); // Clase de la excepción anterior
    CLI::write('  ' . $prevException->getMessage()); // Mensaje de la excepción anterior
    CLI::write('  at ' . CLI::color(clean_path($prevException->getFile()) . ':' . $prevException->getLine(), 'green')); // Ubicación
    CLI::newLine();
}

// Si está habilitado el backtrace, imprime la traza de la excepción
if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE) {
    $backtraces = $last->getTrace(); // Obtiene el arreglo de trazas

    if ($backtraces) {
        CLI::write('Backtrace:', 'green'); // Título del bloque
    }

    // Recorre cada traza y la imprime formateada
    foreach ($backtraces as $i => $error) {
        $padFile  = '    '; // 4 spaces, // Sangría para archivo
        $padClass = '       '; // 7 spaces, // Sangría para clase
        $c        = str_pad($i + 1, 3, ' ', STR_PAD_LEFT); // Número de traza con padding

        // Imprime la ruta del archivo y línea de código o función interna
        if (isset($error['file'])) {
            $filepath = clean_path($error['file']) . ':' . $error['line'];

            CLI::write($c . $padFile . CLI::color($filepath, 'yellow'));
        } else {
            CLI::write($c . $padFile . CLI::color('[internal function]', 'yellow'));
        }

        // Construye el nombre de la función o método con clase y tipo (-> o ::)
        $function = '';

        if (isset($error['class'])) {
            $type = ($error['type'] === '->') ? '()' . $error['type'] : $error['type'];
            $function .= $padClass . $error['class'] . $type . $error['function'];
        } elseif (! isset($error['class']) && isset($error['function'])) {
            $function .= $padClass . $error['function'];
        }

         // Prepara los argumentos pasados a esa función para mostrarlos como texto
        $args = implode(', ', array_map(static fn ($value): string => match (true) {
            is_object($value) => 'Object(' . $value::class . ')', // Muestra la clase del objeto
            is_array($value)  => $value !== [] ? '[...]' : '[]', // Arreglos resumidos
            $value === null   => 'null', // Nulos como texto
            default           => var_export($value, true), // Otros tipos con exportación
        }, array_values($error['args'] ?? [])));

        // Añade los argumentos al string de función
        $function .= '(' . $args . ')';

        // Imprime la función completa con sus argumentos
        CLI::write($function);
        CLI::newLine();
    }
}
