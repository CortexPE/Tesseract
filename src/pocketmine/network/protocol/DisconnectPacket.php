<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>


use pocketmine\network\NetworkSession;

class DisconnectPacket extends DataPacket{

	const NETWORK_ID = Info::DISCONNECT_PACKET;

	public $hideDisconnectionScreen = false;
	public $message;

	public function decode(){
		$this->hideDisconnectionScreen = $this->getBool();
		$this->message = $this->getString();
	}

	public function encode(){
		$this->reset();
		$this->putBool($this->hideDisconnectionScreen);
		$this->putString($this->message);
	}

	/**
	 * @return PacketName|string
     */
	public function getName(){
		return "DisconnectPacket";
	}

    public function handle(NetworkSession $session) : bool{
        return $session->handleDisconnect($this);
    }
}
