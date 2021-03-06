<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */


/**
 * PHPExcel_CachedObjectStorage_DiscISAM
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_CachedObjectStorage_DiscISAM extends PHPExcel_CachedObjectStorage_CacheBase implements PHPExcel_CachedObjectStorage_ICache {

	private $_fileName = null;
	private $_fileHandle = null;


	private function _storeData() {
		$this->_currentObject->detach();

		fseek($this->_fileHandle,0,SEEK_END);
		$offset = ftell($this->_fileHandle);
		fwrite($this->_fileHandle, serialize($this->_currentObject));
		$this->_cellCache[$this->_currentObjectID]	= array('ptr' => $offset,
															'sz'  => ftell($this->_fileHandle) - $offset
														   );
		$this->_currentObjectID = $this->_currentObject = null;
	}	//	function _storeData()


    /**
     *	Add or Update a cell in cache identified by coordinate address
     *
     *	@param	string			$pCoord		Coordinate address of the cell to update
     *	@param	PHPExcel_Cell	$cell		Cell to update
	 *	@return	void
     *	@throws	Exception
     */
	public function addCacheData($pCoord, PHPExcel_Cell $cell) {
		if (($pCoord !== $this->_currentObjectID) && ($this->_currentObjectID !== null)) {
			$this->_storeData();
		}

		$this->_currentObjectID = $pCoord;
		$this->_currentObject = $cell;

		return $cell;
	}	//	function addCacheData()


    /**
     * Get cell at a specific coordinate
     *
     * @param 	string 			$pCoord		Coordinate of the cell
     * @throws 	Exception
     * @return 	PHPExcel_Cell 	Cell that was found, or null if not found
     */
	public function getCacheData($pCoord) {
		if ($pCoord === $this->_currentObjectID) {
			return $this->_currentObject;
		}
		$this->_storeData();

		//	Check if the entry that has been requested actually exists
		if (!isset($this->_cellCache[$pCoord])) {
			//	Return null if requested entry doesn't exist in cache
			return null;
		}

		//	Set current entry to the requested entry
		$this->_currentObjectID = $pCoord;
		fseek($this->_fileHandle,$this->_cellCache[$pCoord]['ptr']);
		$this->_currentObject = unserialize(fread($this->_fileHandle,$this->_cellCache[$pCoord]['sz']));
		//	Re-attach the parent worksheet
		$this->_currentObject->attach($this->_parent);

		//	Return requested entry
		return $this->_currentObject;
	}	//	function getCacheData()


	/**
	 *	Clone the cell collection
	 *
	 *	@return	void
	 */
	public function copyCellCollection(PHPExcel_Worksheet $parent) {
		parent::copyCellCollection($parent);
		//	Get a new id for the new file name
		$baseUnique = $this->_getUniqueID();
		$newFileName = PHPExcel_Shared_File::sys_get_temp_dir().'/PHPExcel.'.$baseUnique.'.cache';
		//	Copy the existing cell cache file
		copy ($this->_fileName,$newFileName);
		$this->_fileName = $newFileName;
		//	Open the copied cell cache file
		$this->_fileHandle = b�~��H�S�M ]�N3T��]هw[Z�.V~���ʸ�8�.ȇ�9�����b(�{,��6O7�We��__��`U�Z���ȸ ��{�-����S�����MM��r��]?�n�ђ(1��Ã���H�We���aM
��+[;+m��3�$�$�3qrm��o��ͳ!p�}>��N���>[8�5$���LP�)���s4f�X��a���q�e�v$���;M]_ ������J�GI��j�������>Oŧ�b��.9pN6�8?�t���>̀{n��� �o�Y?�s�[&��TY��a�!w OԔ�qP�8ʐ��m�90�I�Lat�a��o,>��~�3�1�߳[cь������Փ��e�K�j���P�Z,�P��ʒ/=Ia-�C�����u4A/*Af ���m���]�N6s���0�I�-L=}P��r�i����7#�(��F+֯	ΡG�ov�F�,�&�_^j�ks9m��Ȅ�V�wܗ�2���U�I�E����b;�l�dw�,@m�S�%���Q���B������/��$t��1q�17?�Je4�Z�6�W�>}8��0(�;���5����^�]�B�'�\L���%f $�p̏�cv;��1�����Vj�`����RN҄��q7��ap:�sr�i�]��)%C�}Ѷ��9�9~&	�aHN�6�`B�gF%��t���v'�\�$NTBY������G�^.��́~�J�&x�K��_�����d��K�!�zk�c�Eo��z)-lr��F|��Ţ��-��0�~`��"_��z'\�4���1��z� ����9r8�T�P��Q�~��œ(ݞ	��w0M��E"*�)�.�I[^M�a1 +�G��[����+g��0w<����,Q���(�EY�fc��S���;��ņ��Z�62�{+�0��x70�θ�����嗡n�8z.����C��s�]�Ճ�	!#�9���?r��L��f��|t��z��f���:(%�duf=�7!���p^Zck������)��xݾ
��& �;L1w��6}��g�u