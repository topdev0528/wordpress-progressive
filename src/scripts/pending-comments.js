/**
 * Copyright 2017 Google Inc. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *     http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

import {instance as globalRouter} from './router.js';

let commentPanel;
async function updatePanel() {
  if(!commentPanel) {
    commentPanel = document.querySelector('#pendingcomments');
    if(commentPanel) {
      commentPanel.addEventListener('click', async event => {
        if(event.target.tagName !== 'BUTTON') return;
        await _bgSyncManager.trigger();
        updatePanel();
      });
    }
  }
  if(!commentPanel) return;

  const numPending =
    (await _bgSyncManager.getAll())
      .filter(req => new URL(req.request.referrer).pathname === location.pathname)
      .length;

  if(numPending <= 0) {
    commentPanel.innerHTML = '';
    return;
  }

  commentPanel.innerHTML = `${numPending} comments are pending submission.`;
  if(await _bgSyncManager.isSyncing())
    commentPanel.innerHTML += ` Waiting...`;
  else
    commentPanel.innerHTML += ` Failed. <button>Try again</button>`;
}

updatePanel();
_pubsubhub.subscribe('navigation', _ => {
  commentPanel = null;
  updatePanel();
});
_pubsubhub.subscribe('comment_update', _ => updatePanel());
