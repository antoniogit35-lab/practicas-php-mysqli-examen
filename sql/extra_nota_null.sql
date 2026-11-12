-- Opcional: añade una matrícula sin calificar para practicar «Pendiente».
USE centro;

INSERT INTO matriculas (dni, codigo, anio, nota)
VALUES ('44444444R', 3, 2026, NULL);

-- Para deshacerlo:
-- DELETE FROM matriculas
-- WHERE dni = '44444444R' AND codigo = 3 AND anio = 2026;
