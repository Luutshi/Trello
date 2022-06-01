# Documentation API Trello

## Informations à savoir
#### J'ai ajouté la base de donnée que j'ai fait dans le repo. (```db.sql```)
.

## Tasks requests
* ```POST```    /tasks/
    - ##### Create a task (empty string as name)
* ```GET```     /tasks/
    - ##### Get each tasks (only task and not the steps of the task)
* ```GET```     /tasks/```task_id```/
    - ##### Get a task by an id
* ```PUT```     /tasks/```task_id```/
    - ##### Edit a task (values: name)
* ```DELETE```  /tasks/```task_id```/
    - ##### Delete a task


## Steps (of tasks) requests
* ```POST```    /tasks/```task_id```/steps/
    - ##### Create a step (empty string as name)
* ```GET```     /tasks/steps/
    - ##### Get each steps of each tasks
* ```GET```     /tasks/```task_id```/steps/```step_id```/
    - ##### Get each steps of a task by it's id
* ```PUT```     /tasks/```task_id```/steps/```step_id```/
    - ##### Edit a step
* ```DELETE```  /tasks/```task_id```/steps/```step_id```/
    - ##### Delete a step from it's task