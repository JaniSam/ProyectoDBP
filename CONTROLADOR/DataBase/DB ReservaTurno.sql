create database ReservaTurno

create table Usuarios(
    idUsuario int auto_increment primary key,
    nomUsu varchar(10) not null,
    clave varchar(8) not null,
    rolUsu ENUM('Admi','Empleado')
)

create table Especialidades(
    idEspecialidad int auto_increment primary key,
    nombreEsp varchar(50) not NULL
)

create table Profesionales(
    idProfesional int auto_increment primary key,
    nombreProf varchar(20) not null,
    idEspecialidad int not null,
    constraint fkidEspecialidad foreign key (idEspecialidad) references Especialidades (idEspecialidad)
)

create table Turnos(
    idTurno int auto_increment primary key,
    idProfesional int not null,
    constraint fkIdProfesional foreign key (idProfesional) references Profesionales(idProfesional),
    hora_fecha dateTime not null,
    precio double not null
)

create table ReservaTurnos(
    idReservaT int auto_increment primary key,
    cedulaCli int not null,
    nombreCli varchar(50) not null,
    idTurno int not null,
    constraint fkidTurno foreign key (idTurno) references Turnos (idTurno),
    estado ENUM ('Pendiente', 'Anulado', 'Atendido')
)

-- consulta para insertar registros de:
-- usuarios
INSERT INTO usuarios (nomUsu, clave, rolUsu) VALUES
('Jani123', '123jani', 1),
('Moni34', 'mon43', 2),
('Yeni74', 'yen64', 2)

-- Especialidades
INSERT INTO especialidades (nombreEsp) VALUES
('Dermatología'),
('Ginecología'),
('Odontologia'),
('Pediatría')
SELECT * FROM especialidades

-- Profesionales
INSERT INTO profesionales (nombreProf, idEspecialidad) VALUES
('Hyun Jae Cho Kwon',3),
('Mauricio Caceres', 2),
('Lee Senturion', 1),
('Franchezco',4)
SELECT * FROM profesionales

-- Turnos 
INSERT INTO turnos (idProfesional, hora_fecha, precio) VALUES
(1, '2024-12-11 16:00:00', 35000),
(4, '2024-12-12 09:30:00', 50000),
(3, '2024-12-31 23:59:59', 65000),
(2, '2024-12-09 14:30:00', 50000)
SELECT *FROM turnos

-- Reserva de Turnos
INSERT INTO reservaturnos (cedulaCli, nombreCli, idTurno, estado) VALUES
(25445, 'Flaudelio', 2, 2),
(5214445 ,'Fredy', 1,2)
SELECT * FROM reservaturnos

-- consulta para visualizar registros 
SELECT 
    rt.cedulaCli, 
    rt.nombreCli, 
    e.nombreEsp AS especialidad, 
    p.nombreProf AS profesional, 
    t.hora_fecha AS fecha_turno, 
    rt.estado AS estado_turno
FROM 
    reservaturnos AS rt
INNER JOIN 
    turnos AS t ON rt.idTurno = t.idTurno
INNER JOIN 
    profesionales AS p ON t.idProfesional = p.idProfesional
INNER JOIN 
    especialidades AS e ON p.idEspecialidad = e.idEspecialidad
WHERE 
    t.hora_fecha = '2024-12-09 14:30:00' ;


-- consulta para validar usuario
SELECT * FROM usuarios WHERE nomUsu = 'Jani123' AND clave = '123jani';

-- consulta para visualizar turnos 
SELECT 
    t.idTurno, 
    e.nombreEsp AS especialidad 
FROM 
    turnos t 
INNER JOIN 
    profesionales p ON t.idProfesional = p.idProfesional
INNER JOIN 
    especialidades e ON p.idEspecialidad = e.idEspecialidad;
