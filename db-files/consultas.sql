---medicos disponibles en una hora especifica----

SELECT NOMBRE "Medicos Disponibles" FROM MEDICO
MINUS
SELECT NOMBRE FROM
(SELECT CI_MEDICO, FECHA FROM CITA
UNION ALL
SELECT CI_MEDICO, FECHA FROM CITA_TRATAMIENTO)
JOIN
MEDICO
ON(CI_MEDICO=CI)
WHERE FECHA=TO_DATE('&FECHA','DD/MM/YY:HH');

----tratamientos realizados en un dia------

SELECT P.NOMBRE "Paciente", M.NOMBRE "Medico", T.DESCRIPCION "Descripcion"
FROM CITA_TRATAMIENTO CT
JOIN CITA C ON(CT.CITA_ID=C.ID)
JOIN PACIENTE P ON (C.CI_PACIENTE=P.CI) JOIN MEDICO M ON(CT.CI_MEDICO=M.CI)
JOIN TRATAMIENTO T ON(CT.TRATAMIENTO_ID=T.ID)
WHERE CT.FECHA=TO_DATE('&FECHA','DD/MM/YY');

------CITAS DE MEDICO EN UN RANGO-----
SELECT P.NOMBRE, C.FECHA FROM CITA C JOIN PACIENTE P
ON(C.CI_PACIENTE=P.CI)
WHERE C.CI_MEDICO='&CEDULAMEDICO' AND
C.FECHA BETWEEN TO_DATE('&FINI','DD/MM/YY') AND TO_DATE('&FFIN','DD/MM/YY');

------------EL DERROCHADOR-----------------------
SELECT M.NOMBRE "Medico", SUM(TI.CANTIDAD) "Cantidad utilizada" FROM CITA_TRATAMIENTO CT JOIN
TRATAMIENTO_IMPLEMENTO TI ON(CT.CITA_ID=TI.CITA_ID AND CT.TRATAMIENTO_ID=TI.TRATAMIENTO_ID)
JOIN MEDICO M ON(M.CI=CT.CI_MEDICO)
JOIN IMPLEMENTO I ON(I.ID=TI.IMPLEMENTO_ID)
GROUP BY I.ID, M.NOMBRE HAVING (I.ID=&IDIMPLEMENTO) ORDER BY 2;
