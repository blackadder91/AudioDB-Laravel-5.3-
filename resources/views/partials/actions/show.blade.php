<li><a id="entity_new" href="{{ route($entity_type . '.create') }}">New</a></li>
<li><a id="entity_edit" href="{{ route($entity_type . '.edit', array( 'id' => $entity_id)) }}">Edit</a></li>
<li><a id="entity_destroy" href="{{ route($entity_type . '.destroy', array( 'id' => $entity_id)) }}" data-func="delete" data-route="">Delete</a></li>
<li><a id="back_to_index" href="{{ route($entity_type . '.index') }}">Back to index</a></li>
