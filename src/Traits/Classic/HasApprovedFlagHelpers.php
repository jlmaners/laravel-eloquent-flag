<?php

/*
 * This file is part of Laravel Eloquent Flag.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Cog\Flag\Traits\Classic;

trait HasApprovedFlagHelpers
{
    public function initializeHasApprovedFlagHelpers(): void
    {
        $this->casts['is_approved'] = 'boolean';
    }

    public function isApproved(): bool
    {
        return $this->getAttributeValue('is_approved');
    }

    public function isNotApproved(): bool
    {
        return !$this->isApproved();
    }

    public function approve(): void
    {
        $this->setAttribute('is_approved', true);
        $this->save();

        $this->fireModelEvent('approved', false);
    }

    public function undoApprove(): void
    {
        $this->setAttribute('is_approved', false);
        $this->save();

        $this->fireModelEvent('approvedUndone', false);
    }
}
