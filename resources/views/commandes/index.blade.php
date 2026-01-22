<form method="GET" action="{{ route('commandes.index') }}">
    <input type="text" name="search_client" placeholder="Chercher un client...">
    <button type="submit">Rechercher</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Client</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($commandes as $cmd)
        <tr>
            <td>{{ $cmd->id }}</td>
            <td>{{ $cmd->date }}</td>
            <td>{{ $cmd->client->nom }} {{ $cmd->client->prenom }}</td>
            <td>
                <a href="{{ route('commandes.index', ['page' => request('page'), 'commande_id' => $cmd->id]) }}">Détails</a>
                <a href="{{ route('commandes.edit', $cmd->id) }}">Modifier</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $commandes->links() }}

@if(isset($selectedCommande))
    <div id="details">
        <h3>Détails de la commande #{{ $selectedCommande->id }}</h3>
        <ul>
            @foreach($selectedCommande->produits as $prod)
                <li>{{ $prod->nom }} - Quantité: {{ $prod->pivot->qte_cmd }} - Prix U: {{ $prod->prix }}</li>
            @endforeach
        </ul>
    </div>
@endif
