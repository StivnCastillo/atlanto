 <?php
/**
 *
 * Clase para calcular las horas empleadas en cierta tarea que tiene 
 * una fecha de inicio y una fecha de fin dentro del horario laboral (8am a 6pm por defecto)
 *
 * @author        imosai.co / Stiven Castillo
 * @copyright    Copyright (c) 2013, imosaico.
 * @link        http://github.com/stivncastillo
 * @since        Version 1.0
 * @version     1.0
 */
class Horas_laborales
{
    public $hora_entrada;
    public $hora_salida;
    //Formato de hora: 24Hrs
    function __construct($hora_entrada = '08', $hora_salida = '18')
    {
        $this->hora_entrada = $hora_entrada;
        $this->hora_salida  = $hora_salida;
    }
    // ------------------------------------------------------------------------
    /**
     * calcular
     *
     * Recibe como parametros dos fechas, en formado string ("Y-m-d H:i:s")
     *
     * @access    public
     * @param    string     fecha_inicio fecha en la que se inicia la tarea
     * @param    string    fecha_inicio fecha en la que se finaliza la tarea
     * @return    array
     */
    public function calcular($fecha_inicio, $fecha_fin)
    {
        //Obtener las fechas correspondientes en formato arreglo: array(yyy,MM,dd,hh,mm,ss)
        $fecha_inicio_array = $this->convertir($fecha_inicio);
        $fecha_fin_array = $this->convertir($fecha_fin);

        //While infinito
        $i = 0;
        $c_minutos = 0;
        while (true) {
            //acumular la suma de los minutos de la fecha de inicio y le sumo 1
            $minuto = $fecha_inicio_array[4]+$i;
            //convertir la fecha a formato string ("Y-m-d H:i:s") para comparar con la fecha de fin
            $fecha_2 = date("Y-m-d H:i:s", mktime($fecha_inicio_array[3], $minuto, $fecha_inicio_array[5], $fecha_inicio_array[1], $fecha_inicio_array[2], $fecha_inicio_array[0]));
            //Obtener fecha unix
            $fecha_inicio_unix = strtotime($fecha_2);
            //Obtener el nombre del dia de la semana
            $dia = date('D', mktime($fecha_inicio_array[3], $minuto, $fecha_inicio_array[5], $fecha_inicio_array[1], $fecha_inicio_array[2], $fecha_inicio_array[0]));
            //Se verifica que el dia sea diferente a sabado y domingo (que son dias no laborales)
            if ($dia != 'Sat' AND $dia != 'Sun') {
                $fecha_inicio_array2 = $this->convertir($fecha_2);
                if($this->hora_laboral($fecha_inicio_array2[3])){
                    if(substr($fecha_2, 0, -3) == substr($fecha_fin, 0, -3)){
                        break;
                    }
                    $c_minutos++;
                }
            }
            $i++;
        }
        $f = array(
            'minutos' => $c_minutos,
            'horas' => $c_minutos/60,
            'dias' => ($c_minutos/60)/24,
            'meses' => (($c_minutos/60)/24)/12
        );

        return $f;
    }
    // ------------------------------------------------------------------------
    /**
     * convertir
     *
     * Recibe como parametros la fecha, en formado string ("Y-m-d H:i:s")
     *
     * @access    public
     * @param     string    fecha la fecha que se desea convertir a array
     * @return    array
     */
    private function convertir($fecha)
    {
        $fecha   = explode(' ', $fecha);
        $fecha_s = $fecha[0];
        $hora    = $fecha[1];
        $fecha   = explode('-', $fecha_s);
        $hora    = explode(':', $hora);
        return array_merge($fecha, $hora);
    }
    // ------------------------------------------------------------------------
    /**
     * convertir
     *
     * Recibe como parametros la hora
     *
     * @access    public
     * @param     string    hora, para saber si es laboral o no
     * @return    boolean
     */
    private function hora_laboral($hora)
    {
        if ($hora < $this->hora_entrada) {
            return false;
        }
        if ($hora >= $this->hora_salida) {
            return false;
        }
        return true;
    }
}
?> 