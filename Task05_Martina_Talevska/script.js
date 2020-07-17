$(document).ready(function() {
	loadTasks()
	loadCategories()
	
	$('#form').submit(function(event) {
		event.preventDefault()
	})
})

function loadTasks() {
	var input = localStorage.getItem('tasks')
	if (input != null) {
		var existingTasks = input.split('\n')
		existingTasks.forEach(function(task) {
			var taskFields = task.split(';')
			var taskObject = {
				index: taskFields[0],
				taskName: taskFields[1],
				catName: taskFields[2],
				datetime: taskFields[3]
			}

			addTask(taskObject, false)
		})
	}	
}

function saveTasksToMemory(elArray) {
	var output = ''

	elArray.each(function(index, el) {
		$(el).children().each(function(indexTd, elTd) {
			var colValue = $(elTd).text()
			output += colValue + ';'
		})
		output = output.substring(0, output.length - 1)
		output += '\n'
	})

	output = output.trim()
	localStorage.setItem('tasks', output)
}

function loadCategories() {
	var input = localStorage.getItem('categories')

	if (input != null) {
		var categories = input.split(';')
		categories.forEach(function(cat) {
			addCat(cat)
		})
	}
}

function saveCategoriesToMemory() {
	var output = ''
	var categories = $('#categories')

	categories.children().each(function(index, cat) {
		var catName = $(cat).text()
		output += catName + ';'
	})
	output = output.substring(0, output.length - 1)

	localStorage.setItem('categories', output)
}

function addCat(predefinedCatName) {
	var catName = predefinedCatName
	if (catName == null) {
		catName = $('#catName').val().trim()
	}

	if (catName !== "") {
		var categories = $('#categories')
		var category = $('<li>' + catName + '</li>')
		category.addClass('category')
		category.click(function() {
			var isActive = category.hasClass('active')
			if (isActive) {
				category.removeClass('active')
			} else {
				$('.active').removeClass('active')
				category.addClass('active')
			}
		})
		categories.append(category)
		$('#catName').val('')
		saveCategoriesToMemory()
	}
}

function removeCat() {
	$('.category.active').remove()
	saveCategoriesToMemory()
}

function addTask(predefinedDataObj, shouldSave) {
	var dataObj = {}
	if (predefinedDataObj != null) {
		dataObj = predefinedDataObj
	} else {
		dataObj.taskName = $('#taskName').val().trim()
		dataObj.catName = $('.category.active').first().text()
		dataObj.datetime = new Date().toUTCString()
		dataObj.index = $('.task').length + 1
	}
	
	var taskRow = $('<tr></tr>')
	taskRow.append($('<td>' + dataObj.index + '</td>'))
	taskRow.append($('<td>' + dataObj.taskName + '</td>'))
	taskRow.append($('<td>' + dataObj.catName + '</td>'))
	taskRow.append($('<td>' + dataObj.datetime + '</td>'))
	taskRow.addClass('task')
	
	taskRow.click(function() {
		taskRow.toggleClass('active')
	})
	
	$('#tasks').append(taskRow)
	$('#taskName').val('')
	if (shouldSave) {
		saveTasksToMemory($('#tasks > tbody').children('.task'))
	}	
}

function removeTasks() {
	$('.task.active').remove()
	saveTasksToMemory($('#tasks > tbody').children('.task'))
}
