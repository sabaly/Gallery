<?php

	require "../Models/autoload.php";

	$db = DBFactory::getMysqlConnexionWithPDO();
	$reaction_manager = new reactionManager_PDO($db);


	if(isset($_GET['type']))
	{
		$react = new Reaction(
			[
				'type' => $_GET['type'],
			]
		);

		$react->setIdArticle(4);

		$react->setIdClient(1);

		$reaction_manager->react($react);
		$reaction_manager->unReact(2);
	}


	//formulaire
	$form = "<form>
				<label>type</label>
				<select name='type'>
					<option value='1'>Like</option>
					<option value='2'>adore</option>
					<option value='3'>dingue</option>
				</select>
				<input type='submit' value='envoyer'/>
			</form><br/><br/><hr>";

	echo $form;
?>
<!--table>
	<thead>
		<th>
			Nom
		</th>
		<th>
			Description
		</th>
	</thead>
	<tbody>
		<tr>
			<td style="padding-right: 30px; border: 2px solid #000;"></td>
			<td style="padding-right: 30px; border: 2px solid #000;"></td>
		</tr>
	</tbody>
</table-->
