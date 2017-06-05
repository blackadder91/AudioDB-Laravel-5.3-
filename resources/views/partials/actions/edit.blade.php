<li><a id="entity_destroy" href="{{ route($entity_type . '.destroy', array( 'id' => $entity_id)) }}" data-func="delete" data-route="">Delete</a></li>
<li><a id="back_to_view" href="{{ route($entity_type . '.show', array( 'id' => $entity_id)) }}">Back to view</a></li>
<li><a id="back_to_index" href="{{ route($entity_type . '.index') }}">Back to index</a></li>
