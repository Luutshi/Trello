window.addEventListener('DOMContentLoaded', () => {
    let tasksP = document.querySelectorAll('div.task--header > p')
    let tasksInput = document.querySelectorAll('div.task--header > input')
    let tasksSpan = document.querySelectorAll('div.task--header > span')
    let stepP = document.querySelectorAll('div.step > p')
    let stepInput = document.querySelectorAll('div.step > input')
    let stepsSpan = document.querySelectorAll('div.step > span')
    let addStep = document.querySelectorAll('div.task > div.addStep')


    function deleteTask(x) {
        x.addEventListener('click', () => {
            fetch(`/tasks/${x.id}`, {
                method: 'DELETE',
            })
            .then(() => {
                document.querySelector(`div.task${x.id}`).remove()
            })
        })    
    }

    function deleteStep(x) {
        x.addEventListener('click', () => {
            let regex = x.id.match(/^t(\d+)s(\d+)$/)

            fetch(`/tasks/${regex[1]}/steps/${regex[2]}/`, {
                method: 'DELETE',
            })
            .then(() => {
                document.querySelector(`div.step${regex[2]}`).remove()
            })
        })
    }

    function addStepFunc(x) {
        x.addEventListener('click', () => {
            fetch(`/tasks/${x.id}/steps/`, {
                method: 'POST',
            })
            .then((response) => response.json())
            .then((res) => {
                let newDiv = document.createElement('div')
                newDiv.className = `step step${res.data.id}`

                let newInput = document.createElement('input')
                newInput.placeholder = 'Enter a step name.'
                newInput.id = `t${res.data.task_id}s${res.data.id}`

                let newSpan = document.createElement('span')
                let spanContent = document.createTextNode('❌')
                newSpan.id = `t${res.data.task_id}s${res.data.id}`
                newSpan.append(spanContent)

                newDiv.append(newInput)
                newDiv.append(newSpan)

                newInput.addEventListener('change', stepInputToP(newInput))                
                newSpan.addEventListener('click', deleteStep(newSpan))  
                document.querySelector(`div.task${x.id} > div.steps`).append(newDiv)              
            })
        })
    }

    function taskInputToP(x) {
        x.addEventListener('change', () => {
            fetch(`/tasks/${x.id}/`, {
                method: 'PUT',
                body: JSON.stringify({
                    "name": x.value,
                })
            })
            .then(() => {
                let newP = document.createElement('p')
                newP.id = x.id
                let pContent = document.createTextNode(x.value)
                newP.append(pContent)

                x.remove()
                newP.addEventListener('click', taskPToInput(newP))  
                document.querySelector(`div.task${x.id} > div.task--header`).prepend(newP)
            })
        })
    }

    function taskPToInput(x) {
        x.addEventListener('click', () => {
            let newInput = document.createElement('input')
            newInput.id = x.id
            newInput.value = x.innerText

            x.remove()
            document.querySelector(`div.task${x.id} > div.task--header`).prepend(newInput)

            newInput.addEventListener('click', taskInputToP(newInput))  
            newInput.select()
        })
    }

    function stepInputToP(x) {
        x.addEventListener('change', () => {
            let regex = x.id.match(/^t(\d+)s(\d+)$/)

            fetch(`/tasks/${regex[1]}/steps/${regex[2]}`, {
                method: 'PUT',
                body: JSON.stringify({
                    "name": x.value,
                    "done": 0
                })
            })
            .then(() => {
                let newP = document.createElement('p')
                newP.id = `t${regex[1]}s${regex[2]}`
                let pContent = document.createTextNode(x.value)
                newP.append(pContent)

                x.remove()

                newP.addEventListener('click', stepPToInput(newP))  
                document.querySelector(`.step${regex[2]}`).prepend(newP)
            })
        })
    }

    function stepPToInput(x) {
        x.addEventListener('click', () => {
            let regex = x.id.match(/^t(\d+)s(\d+)$/)

            let newInput = document.createElement('input')
            newInput.id = x.id
            newInput.value = x.innerText

            x.remove()
            document.querySelector(`div.task${regex[1]} div.step${regex[2]}`).prepend(newInput)

            newInput.addEventListener('click', stepInputToP(newInput))  
            newInput.select()
        })
    }

    tasksP.forEach((x) => taskPToInput(x));
    tasksInput.forEach((x) => {
        x.value = ''
        taskInputToP(x)
    });
    tasksSpan.forEach((x) => deleteTask(x))

    stepP.forEach((x) => stepPToInput(x));
    stepInput.forEach((x) => {
        x.value = ''
        stepInputToP(x)
    });
    stepsSpan.forEach((x) => deleteStep(x))

    addStep.forEach((x) => addStepFunc(x))

    

    document.querySelector('div.addTask').addEventListener('click', () => {
        fetch(`/tasks/`, {
            method: 'POST',
        })
        .then((response) => response.json())
        .then((res) => {
            let newTask = document.createElement('div')
            newTask.className = `task task${res.data.id}`

            let taskHeader = document.createElement('div')
            let headerInput = document.createElement('input')
            headerInput.placeholder = 'Enter a task name.'
            headerInput.id = res.data.id
            let headerSpan = document.createElement('span')
            let spanContent = document.createTextNode('❌')
            headerSpan.id = res.data.id
            headerSpan.append(spanContent)
            taskHeader.className = 'task--header'
            taskHeader.append(headerInput)
            taskHeader.append(headerSpan)

            let stepsDiv = document.createElement('div')
            stepsDiv.className = 'steps'

            let addStepDiv = document.createElement('div')
            addStepDiv.className = 'addStep'
            addStepDiv.id = res.data.id
            let addStepContent = document.createTextNode('+')
            addStepDiv.append(addStepContent)

            newTask.append(taskHeader)
            newTask.append(stepsDiv)
            newTask.append(addStepDiv)


            document.querySelector('div.tasks').append(newTask)

            headerInput.addEventListener('click', taskInputToP(headerInput))
            headerSpan.addEventListener('click', deleteTask(headerSpan))
            addStepDiv.addEventListener('click', addStepFunc(addStepDiv))
        })
    })
})