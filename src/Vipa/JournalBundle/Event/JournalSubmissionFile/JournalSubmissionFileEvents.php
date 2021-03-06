<?php

namespace Vipa\JournalBundle\Event\JournalSubmissionFile;

use Vipa\CoreBundle\Events\EventDetail;
use Vipa\CoreBundle\Events\MailEventsInterface;

final class JournalSubmissionFileEvents implements MailEventsInterface
{
    const LISTED = 'vipa.journal_submission_file.list';

    const PRE_CREATE = 'vipa.journal_submission_file.pre_create';

    const POST_CREATE = 'vipa.journal_submission_file.post_create';

    const PRE_UPDATE = 'vipa.journal_submission_file.pre_update';

    const POST_UPDATE = 'vipa.journal_submission_file.post_update';

    const PRE_DELETE = 'vipa.journal_submission_file.pre_delete';

    const POST_DELETE = 'vipa.journal_submission_file.post_delete';

    public function getMailEventsOptions()
    {
        return [
            new EventDetail(self::POST_CREATE, 'journal', [
                'submission.file', 'done.by', 'receiver.username', 'receiver.fullName',
            ]),
            new EventDetail(self::POST_UPDATE, 'journal', [
                'submission.file', 'done.by', 'receiver.username', 'receiver.fullName',
            ]),
            new EventDetail(self::PRE_DELETE, 'journal', [
                'submission.file', 'done.by', 'receiver.username', 'receiver.fullName',
            ]),
        ];
    }
}
