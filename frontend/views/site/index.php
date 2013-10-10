<?php
/**
 * @var yii\base\View $this
 */
$this->title = 'My Yii Application';
?>
<section id="todoapp" ng-controller="GoalCtrl">
    <header id="header">
        <h1>todos</h1>
        <form id="todo-form" ng-submit="addTodo()">
            <input id="new-todo" placeholder="What needs to be done?" ng-model="newTodo" autofocus>
        </form>
    </header>
    <section id="main" ng-show="todos.length" ng-cloak>
        <input id="toggle-all" type="checkbox" ng-model="allChecked" ng-click="markAll(allChecked)">
        <label for="toggle-all">Mark all as complete</label>
        <ul id="todo-list">
            <li ng-repeat="todo in todos | filter:statusFilter" ng-class="{completed: todo.completed, editing: todo == editedTodo}">
                <div class="view">
                    <input class="toggle" type="checkbox" ng-model="todo.completed">
                    <label ng-dblclick="editTodo(todo)">{{todo.title}}</label>
                    <button class="destroy" ng-click="removeTodo(todo)"></button>
                </div>
                <form ng-submit="doneEditing(todo)">
                    <input class="edit" ng-model="todo.title" todo-escape="revertEditing(todo)" todo-blur="doneEditing(todo)" todo-focus="todo == editedTodo">
                </form>
            </li>
        </ul>
    </section>
    <footer id="footer" ng-show="todos.length" ng-cloak>
				<span id="todo-count"><strong>{{remainingCount}}</strong>
					<ng-pluralize count="remainingCount" when="{ one: 'item left', other: 'items left' }"></ng-pluralize>
				</span>
        <ul id="filters">
            <li>
                <a ng-class="{selected: location.path() == '/'} " href="#/">All</a>
            </li>
            <li>
                <a ng-class="{selected: location.path() == '/active'}" href="#/active">Active</a>
            </li>
            <li>
                <a ng-class="{selected: location.path() == '/completed'}" href="#/completed">Completed</a>
            </li>
        </ul>
        <button id="clear-completed" ng-click="clearCompletedTodos()" ng-show="completedCount">Clear completed ({{completedCount}})</button>
    </footer>
</section>

<!--<div ng-app="MapApp">-->
<!--    <div ng-controller="PlacesListController">-->
<!--        <div pm-google-map></div>-->
<!--        <div ng-view></div>-->
<!--    </div>-->
<!--</div>-->
<div class="site-index">

	<div class="jumbotron">
		<h1>Congratulations!</h1>

		<p class="lead">You have successfully created your Yii-powered application.</p>

		<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
	</div>

	<div class="body-content">

		<div class="row">
			<div class="col-lg-4">
				<h2>Heading</h2>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
					dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					fugiat nulla pariatur.</p>

				<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
			</div>
			<div class="col-lg-4">
				<h2>Heading</h2>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
					dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					fugiat nulla pariatur.</p>

				<p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
			</div>
			<div class="col-lg-4">
				<h2>Heading</h2>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
					dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					fugiat nulla pariatur.</p>

				<p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
			</div>
		</div>

	</div>
</div>
