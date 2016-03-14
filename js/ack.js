function ack(){
    if (!confirm('Supprimer l\'élément? Il ne pourra pas être récupéré')) event.preventDefault();
}