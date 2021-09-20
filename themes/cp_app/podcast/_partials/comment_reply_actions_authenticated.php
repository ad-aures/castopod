<footer>
    <form action="<?= route_to('comment-attempt-like', interact_as_actor()->username, $episode->slug, $reply->id) ?>" method="POST" class="flex items-center gap-x-4">
        <button type="submit" name="action" class="inline-flex items-center hover:underline group" title="<?= lang(
    'Comment.likes',
    [
        'numberOfLikes' => $reply->likes_count,
    ],
) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-400 group-hover:text-red-600') . $reply->likes_count ?></button>
        <Button uri="<?= route_to('comment', $podcast->handle, $episode->slug, $reply->id) ?>" size="small"><?= lang('Comment.reply') ?></Button>
    </form>
</footer>
