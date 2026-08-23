<?php

namespace App\Enums;

enum EstadoTarea: string
{
    case PENDIENTE = 'pendiente';
    case EN_PROCESO = 'en_proceso';
    case COMPLETADA = 'completada';
}