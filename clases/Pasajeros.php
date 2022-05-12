<?php
class Pasajeros
{
    private $DB;

    function __construct($conn)
    {
        $this -> DB = $conn;
    }

    public function Listar($consulta)
    {
        $establecer = $this -> DB -> prepare($consulta);
        $establecer -> execute() > 0;
         
        while($columna = $establecer -> fetch(PDO::FETCH_ASSOC))
        {
            ?> 
            <tr>
            <td><?php echo $columna['idpasajero']?></td>
            <td><?php echo $columna['nombres']?></td>
            <td><?php echo $columna['apellidos']?></td>
            <td><?php echo $columna['telefono']?></td>
            <td><?php echo $columna['dui']?></td>
            <td><?php echo $columna['destino']?></td>
            <td><?php echo $columna['fecha']?></td>
            <td><?php echo $columna['hora']?></td>
            <td>
                <a href="EditarPasajero.php?EditId=<?php echo $columna['idpasajero']?>" class="btn btn-warning">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
            <td>
                <a href="EliminarPasajero.php?ElimId=<?php echo $columna['idpasajero']?>" class="btn btn-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
        </tr>
            
        <?php
        } 
    }

    public function Actualizar($Id, $nombres, $apellidos, $telefono, $dui, $destino, $fecha, $hora)
    {
        try
        {
            $establecer = $this -> DB -> prepare("UPDATE pasajeros SET nombres = :nombres, 
            apellidos = :apellidos, telefono = :telefono, dui = :dui, destino = :destino, 
            fecha = :fecha, hora = :hora WHERE idpasajero = :idpasajero");
            $establecer->bindParam(":nombres", $nombres, PDO::PARAM_STR);
            $establecer->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $establecer->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $establecer->bindParam(":dui", $dui, PDO::PARAM_STR);
            $establecer->bindParam(":destino", $destino, PDO::PARAM_STR);
            $establecer->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $establecer->bindParam(":hora", $hora, PDO::PARAM_STR);
            $establecer->bindParam(":idpasajero", $Id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }

    public function Eliminar($Id)
    {
        try
        {
            $establecer = $this -> DB -> prepare("DELETE FROM pasajeros WHERE idpasajero=:idpasajero");
            $establecer->bindParam(":idpasajero", $Id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }
}
?>