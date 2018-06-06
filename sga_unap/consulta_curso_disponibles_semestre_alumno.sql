SELECT * FROM (SELECT (CASE WHEN Aprobados.Mca_Aprobado = 1 THEN COUNT(Aprobados.Mca_Aprobado) END) AS RequisitosAprobados, 
COUNT(Aprobados.Cue_IdRequisito) AS CantidadRequisitos, Aprobados.* FROM (   SELECT mca.Mca_Aprobado, preRequisitos.* 
FROM (  SELECT curr.Cue_IdRequisito, cursoSemestre.* FROM ( SELECT cur.* FROM usuario_rol usr 
INNER JOIN detalle_alumno dea ON usr.Usr_IdUsuarioRol = dea.Usr_IdUsuarioRol
INNER JOIN curricula cui ON cui.Cui_IdCurricula = dea.Cui_IdCurricula
INNER JOIN ciclo_curricula cic ON cic.Cui_IdCurricula = cui.Cui_IdCurricula
INNER JOIN curso cur ON cur.Ciu_IdCicloCurricula = cic.Ciu_IdCicloCurricula
INNER JOIN carga_academica caa ON caa.Cur_IdCurso = cur.Cur_IdCurso
INNER JOIN semestre sem ON sem.Sem_IdSemestre = caa.Sem_IdSemestre
WHERE usr.Usu_IdUsuario = 1 AND sem.Sem_Ano = 2015 AND sem.Sem_Numero = 'I' AND sem.Sem_Estado = 1 ) cursoSemestre
INNER JOIN curso_requisito curr ON cursoSemestre.Cur_IdCurso = curr.Cue_IdPrincipal  ) preRequisitos
LEFT JOIN carga_academica caac ON preRequisitos.Cue_IdRequisito = caac.Cur_IdCurso 
LEFT JOIN matricula_carga_academica mca ON caac.Caa_IdCargaAcademica = mca.Caa_IdCargaAcademica   ) Aprobados
GROUP BY Aprobados.Cur_IdCurso) CursosDisponibles 
WHERE	CursosDisponibles.RequisitosAprobados = CursosDisponibles.CantidadRequisitos