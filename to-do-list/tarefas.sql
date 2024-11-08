CREATE DATABASE tarefas;
USE `tarefas`; 
CREATE TABLE `tarefa` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT, 
    `nome` VARCHAR(50) NOT NULL, 
    `descricao` VARCHAR(220) NOT NULL, 
    `status` CHAR(1) NOT NULL, 
    `data_limite` DATE NOT NULL, 
    PRIMARY KEY (`id`)
);

INSERT INTO `tarefa` (`id`, `nome`, `descricao`, `status`, `data_limite`) 
VALUES (1, 'Tarefa 1', 'tarefa de teste', 0, '10-11-1999');